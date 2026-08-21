<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Order;
use App\Models\Package;
use App\Models\Transaction;
use App\Payments\Gateways\SslCommerzGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display user dashboard.
     */
    public function dashboard()
    {
        $user = Auth::user();
        return view('user.dashboard', compact('user'));
    }

    /**
     * Show package checkout page.
     */
    public function checkout(Package $package)
    {
        return view('user.checkout', compact('package'));
    }

    /**
     * Process payment via SSLCommerz.
     */
    public function pay(Request $request, Package $package, SslCommerzGateway $gateway)
    {
        $user = Auth::user();

        if (!$user || !$package->is_active) {
            return redirect()->route('user.packages')->with('error', 'Invalid request.');
        }

        $validated = $request->validate([
            'payment_method' => 'required|string|in:sslcommerz',
        ]);

        $requestId = Str::uuid()->toString();
        $storeId = config('sslcommerz.apiCredentials.store_id');
        $isSandbox = config('sslcommerz.apiDomain') === 'https://sandbox.sslcommerz.com';
        $endpoint = config('sslcommerz.apiDomain') . config('sslcommerz.apiUrl.make_payment');

        if (empty($storeId) || empty(config('sslcommerz.apiCredentials.store_password'))) {
            Log::warning('SSLCommerz configuration missing for order payment', [
                'request_id' => $requestId,
                'has_store_id' => !empty($storeId),
                'has_store_password' => !empty(config('sslcommerz.apiCredentials.store_password')),
                'is_sandbox' => $isSandbox,
                'endpoint' => $endpoint,
                'user_id' => $user->id,
                'package_id' => $package->id,
                'error_code' => 'SSLCOMMERZ_CONFIGURATION_ERROR',
            ]);
            return back()->with('error', 'পেমেন্ট কনফিগারেশন সম্পূর্ণ নয়। অনুগ্রহ করে অ্যাডমিনের সাথে যোগাযোগ করুন। (CODE: CONFIG_ERROR)');
        }

        $order = null;
        $transaction = null;
        $result = null;
        $internalTransactionId = 'ORD-' . date('Y') . '-' . str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        while (Order::where('transaction_id', $internalTransactionId)->exists()) {
            $internalTransactionId = 'ORD-' . date('Y') . '-' . str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        }

        try {
            DB::transaction(function () use ($package, $user, &$order, &$transaction, $internalTransactionId) {
                $order = new Order();
                $order->user_id = $user->id;
                $order->package_id = $package->id;
                $order->amount = $package->price;
                $order->status = 'pending';
                $order->payment_method = 'sslcommerz';
                $order->transaction_id = $internalTransactionId;
                $order->gateway = 'sslcommerz';
                $order->save();

                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->order_id = $order->id;
                $transaction->amount = $package->price;
                $transaction->type = 'credit';
                $transaction->status = 'pending';
                $transaction->gateway = 'sslcommerz';
                $transaction->gateway_name = 'sslcommerz';
                $transaction->gateway_session_id = $internalTransactionId;
                $transaction->transaction_id = $internalTransactionId;
                $transaction->currency = 'BDT';
                $transaction->description = 'Payment for package: ' . $package->title;
                $transaction->save();
            });

            Log::info('Order pending created', [
                'request_id' => $requestId,
                'order_id' => $order->id,
                'transaction_id' => $internalTransactionId,
                'user_id' => $user->id,
                'package_id' => $package->id,
                'amount' => $package->price,
                'endpoint' => $endpoint,
                'is_sandbox' => $isSandbox,
            ]);

            $paymentData = [
                'total_amount' => $package->price,
                'currency' => 'BDT',
                'tran_id' => $internalTransactionId,
                'product_category' => 'course_package',
                'product_name' => $package->title,
                'product_profile' => 'non-physical-goods',
                'cus_name' => $user->name,
                'cus_email' => $user->email,
                'cus_country' => 'Bangladesh',
                'value_a' => $order->id,
                'value_b' => $package->id,
            ];

            $result = $gateway->initialize($paymentData);

            if (!$result['success']) {
                $errorCode = str_contains($result['message'] ?? '', 'Store Credential') ? 'SSLCOMMERZ_AUTHENTICATION_ERROR' : 'SSLCOMMERZ_INITIALIZATION_FAILED';
                $order->update(['status' => 'failed']);
                $transaction->update(['status' => 'failed', 'failure_reason' => $result['message'] ?? 'SSLCommerz initialization failed']);
                Log::warning('SSLCommerz order init returned failure', [
                    'request_id' => $requestId,
                    'order_id' => $order->id,
                    'transaction_id' => $internalTransactionId,
                    'error_code' => $errorCode,
                    'gateway_message' => $result['message'] ?? null,
                ]);
                return back()->with('error', 'পেমেন্ট আরম্ভ করতে ব্যর্থ হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন। (' . $errorCode . ')');
            }

            $transaction->update(['status' => 'processing', 'gateway_session_id' => $result['gateway_session_id']]);
            $order->update(['status' => 'processing']);

            Log::info('SSLCommerz order initialized', [
                'request_id' => $requestId,
                'order_id' => $order->id,
                'transaction_id' => $internalTransactionId,
                'gateway_session_id' => $result['gateway_session_id'],
            ]);

            return redirect($result['redirect_url']);

        } catch (\Throwable $e) {
            $exceptionClass = get_class($e);
            $isTimeout = str_contains($e->getMessage(), 'timeout');
            $errorCode = $isTimeout ? 'SSLCOMMERZ_TIMEOUT' : 'SSLCOMMERZ_INITIALIZATION_FAILED';
            if (isset($order) && $order && $order->exists && $order->status === 'pending') {
                try { $order->update(['status' => 'failed']); } catch (\Throwable $inner) {}
            }
            if (isset($transaction) && $transaction && $transaction->exists && $transaction->status === 'pending') {
                try { $transaction->update(['status' => 'failed', 'failure_reason' => $e->getMessage()]); } catch (\Throwable $inner) {}
            }
            Log::error('Order payment SSLCommerz initialization exception', [
                'request_id' => $requestId,
                'exception_class' => $exceptionClass,
                'exception_message' => $e->getMessage(),
                'error_code' => $errorCode,
                'user_id' => $user->id,
                'package_id' => $package->id,
                'transaction_id' => $internalTransactionId ?? null,
                'endpoint' => $endpoint ?? null,
                'is_sandbox' => $isSandbox ?? null,
                'has_store_id' => !empty($storeId),
            ]);
            $debugMessage = app()->environment('local', 'development') ? ' (' . $e->getMessage() . ')' : '';
            return back()->with('error', 'পেমেন্ট আরম্ভ করতে ব্যর্থ হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।' . $debugMessage);
        }
    }
}
