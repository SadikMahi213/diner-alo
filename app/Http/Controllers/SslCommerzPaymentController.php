<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Order;
use App\Models\Transaction;
use App\Payments\Gateways\SslCommerzGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SslCommerzPaymentController extends Controller
{
    protected SslCommerzGateway $gateway;

    public function __construct(SslCommerzGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * Handle SSLCommerz success callback.
     */
    public function success(Request $request)
    {
        Log::info('SSLCommerz success callback received', [
            'request' => $request->except(['_token']),
        ]);

        $valId = $request->input('val_id');
        $tranId = $request->input('tran_id');
        $amount = (float) ($request->input('amount') ?? $request->input('merchant_amount', 0));
        $currency = $request->input('currency', 'BDT');

        if (!$valId || !$tranId) {
            return redirect()->route('home')->with('error', 'Invalid payment response.');
        }

        $this->processCallback($tranId, $amount, $currency, $request->all(), 'success');

        return redirect()->route('home')->with('success', 'আপনার অবদান সফলভাবে গৃহীত হয়েছে।');
    }

    /**
     * Handle SSLCommerz fail callback.
     */
    public function fail(Request $request)
    {
        Log::warning('SSLCommerz fail callback received', [
            'request' => $request->except(['_token']),
        ]);

        $tranId = $request->input('tran_id');
        $amount = (float) ($request->input('amount') ?? 0);
        $currency = $request->input('currency', 'BDT');

        if ($tranId) {
            $this->processCallback($tranId, $amount, $currency, $request->all(), 'failed');
        }

        $failRoute = $this->determineFailRedirect($tranId);
        return redirect()->to($failRoute)->with('error', 'পেমেন্ট ব্যর্হত হয়েছে। কোটিপত চেষ্টা করুন অথবা অন্য পদ্ধতিতে দান করুন।');
    }

    /**
     * Handle SSLCommerz cancel callback.
     */
    public function cancel(Request $request)
    {
        Log::info('SSLCommerz cancel callback received', [
            'request' => $request->except(['_token']),
        ]);

        $tranId = $request->input('tran_id');
        $amount = (float) ($request->input('amount') ?? 0);
        $currency = $request->input('currency', 'BDT');

        if ($tranId) {
            $this->processCallback($tranId, $amount, $currency, $request->all(), 'cancelled');
        }

        $cancelRoute = $this->determineFailRedirect($tranId);
        return redirect()->to($cancelRoute)->with('message', 'পেমেন্ট বাতিল করা হয়েছে।');
    }

    /**
     * Handle SSLCommerz IPN callback.
     */
    public function ipn(Request $request)
    {
        Log::info('SSLCommerz IPN received', [
            'request' => $request->except(['_token']),
        ]);

        $tranId = $request->input('tran_id');
        $amount = (float) ($request->input('amount') ?? $request->input('merchant_amount', 0));
        $currency = $request->input('currency', 'BDT');

        if (!$tranId || !$amount) {
            return response()->json(['status' => 'error', 'message' => 'Invalid IPN data']);
        }

        $this->processCallback($tranId, $amount, $currency, $request->all(), 'ipn');

        return response()->json(['status' => 'success']);
    }

    /**
     * Process a gateway callback with full server-side verification.
     */
    protected function processCallback(string $tranId, float $amount, string $currency, array $postData, string $callbackType): void
    {
        try {
            DB::transaction(function () use ($tranId, $amount, $currency, $postData, $callbackType) {
                $transaction = Transaction::where('gateway_session_id', $tranId)
                    ->orWhere('gateway_transaction_id', $tranId)
                    ->first();

                if (!$transaction) {
                    // Try finding by donation's transaction_id
                    $donation = Donation::where('transaction_id', $tranId)->first();
                    if ($donation) {
                        $transaction = Transaction::where('donation_id', $donation->id)->first();
                    }
                }

                if (!$transaction) {
                    Log::warning('SSLCommerz callback - transaction not found', ['tran_id' => $tranId]);
                    return;
                }

                // Idempotency check: if already paid, skip processing
                if ($transaction->status === 'successful') {
                    Log::info('SSLCommerz callback - payment already processed', [
                        'tran_id' => $tranId,
                        'transaction_id' => $transaction->id,
                    ]);
                    return;
                }

                // Update transaction with gateway data
                $transaction->gateway_response = json_encode($postData);
                $transaction->gateway_transaction_id = $postData['bank_tran_id'] ?? $postData['sslcommerz_tran_id'] ?? $tranId;

                if ($callbackType === 'failed') {
                    $transaction->status = 'failed';
                    $transaction->failure_reason = $postData['failedreason'] ?? ($postData['error'] ?? null);
                    $transaction->save();

                    $this->updateDonationStatus($transaction, 'failed');
                    return;
                }

                if ($callbackType === 'cancelled') {
                    $transaction->status = 'cancelled';
                    $transaction->failure_reason = 'Customer cancelled the payment';
                    $transaction->save();

                    $this->updateDonationStatus($transaction, 'cancelled');
                    return;
                }

                // For success and IPN: validate server-side
                $validation = $this->gateway->validate($tranId, $amount, $currency, $postData);

                if (!$validation['success']) {
                    $transaction->status = 'failed';
                    $transaction->failure_reason = $validation['message'] ?? 'Validation failed';
                    $transaction->save();

                    $this->updateDonationStatus($transaction, 'failed');

                    Log::error('SSLCommerz validation failed', [
                        'tran_id' => $tranId,
                        'amount' => $amount,
                        'message' => $validation['message'] ?? 'Unknown error',
                    ]);
                    return;
                }

                // Amount validation
                if (abs($validation['amount'] - $amount) > 0.01) {
                    $transaction->status = 'failed';
                    $transaction->failure_reason = 'Amount mismatch: expected ' . $amount . ', got ' . $validation['amount'];
                    $transaction->save();

                    $this->updateDonationStatus($transaction, 'failed');

                    Log::warning('SSLCommerz amount mismatch', [
                        'tran_id' => $tranId,
                        'expected' => $amount,
                        'received' => $validation['amount'],
                    ]);
                    return;
                }

                // Success! Update payment state
                $transaction->status = 'successful';
                $transaction->gateway_response = json_encode($postData);
                $transaction->gateway_transaction_id = $validation['gateway_transaction_id'] ?? $tranId;
                $transaction->save();

                // Update donation status
                $this->updateDonationStatus($transaction, 'successful');

                // Update donation fund balance if applicable
                $donation = $transaction->donation;
                if ($donation && $donation->donation_fund_id) {
                    $donation->fund?->increment('current_amount', $donation->amount);
                }

                Log::info('SSLCommerz payment verified and processed', [
                    'tran_id' => $tranId,
                    'transaction_id' => $transaction->id,
                    'amount' => $amount,
                    'callback_type' => $callbackType,
                ]);
            });
        } catch (\Throwable $e) {
            Log::error('SSLCommerz callback processing error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'tran_id' => $tranId,
                'callback_type' => $callbackType,
            ]);
        }
    }

    /**
     * Update the donation status based on transaction result.
     */
    protected function updateDonationStatus(Transaction $transaction, string $status): void
    {
        $donation = $transaction->donation;
        if ($donation && !$donation->isSuccessful()) {
            $donation->status = $status === 'successful' ? 'successful' : $status;
            $donation->payment_method = 'sslcommerz';
            $donation->save();
        }
    }

    /**
     * Determine where to redirect on fail/cancel.
     */
    protected function determineFailRedirect(?string $tranId): string
    {
        if (!$tranId) {
            return route('home');
        }

        // Check if this was a donation or order payment
        $transaction = Transaction::where('gateway_session_id', $tranId)
            ->orWhere('gateway_transaction_id', $tranId)
            ->first();

        if ($transaction) {
            $donation = $transaction->donation;
            if ($donation) {
                return route('donation.create');
            }

            $order = $transaction->order;
            if ($order) {
                return route('user.pay', $order);
            }
        }

        // Fallback: try to find donation by transaction_id
        $donation = Donation::where('transaction_id', $tranId)->first();
        if ($donation) {
            return route('donation.create');
        }

        return route('home');
    }
}
