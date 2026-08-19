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

        try {
            DB::transaction(function () use ($package, $user, $validated, $gateway) {
                // Generate unique internal transaction ID
                $internalTransactionId = 'ORD-' . date('Y') . '-' . str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);

                while (Order::where('transaction_id', $internalTransactionId)->exists()) {
                    $internalTransactionId = 'ORD-' . date('Y') . '-' . str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
                }

                // Create the order record
                $order = new Order();
                $order->user_id = $user->id;
                $order->package_id = $package->id;
                $order->amount = $package->price;
                $order->status = 'pending';
                $order->payment_method = 'sslcommerz';
                $order->transaction_id = $internalTransactionId;
                $order->gateway = 'sslcommerz';
                $order->save();

                // Create transaction record
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

                // Initialize SSLCommerz payment
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
                    $order->update(['status' => 'failed']);
                    $transaction->update([
                        'status' => 'failed',
                        'failure_reason' => $result['message'] ?? 'SSLCommerz initialization failed',
                    ]);
                    throw new \RuntimeException($result['message'] ?? 'Payment initialization failed');
                }

                // Update transaction with gateway session ID
                $transaction->update([
                    'status' => 'processing',
                    'gateway_session_id' => $result['gateway_session_id'],
                ]);

                // Update order status
                $order->update(['status' => 'processing']);
            });

            // Redirect to SSLCommerz payment page
            return redirect($result['redirect_url']);

        } catch (\Throwable $e) {
            Log::error('Order payment SSLCommerz initialization failed', [
                'error' => $e->getMessage(),
                'user_id' => $user->id,
                'package_id' => $package->id,
            ]);
            return back()->with('error', 'পেমেন্ট আরম্ভ করতে ব্যর্হত হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।');
        }
    }
}
