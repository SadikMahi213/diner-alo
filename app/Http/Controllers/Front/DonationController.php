<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Project;
use App\Models\DonationFund;
use App\Models\Transaction;
use App\Models\PaymentMethod;
use App\Payments\Gateways\SslCommerzGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DonationController extends Controller
{
    /**
     * Display the donation form.
     */
    public function create()
    {
        $funds = DonationFund::where('is_active', true)->orderBy('id')->get();
        $projects = Project::where('status', 'running')->take(5)->get();

        return view('front.donation.create', compact('funds', 'projects'))->with('donation', null);
    }

    /**
     * Initialize a donation and redirect to SSLCommerz.
     * Supports reference workflow: fund, contact (phone/email), amount, terms.
     * Also retains backward compat for name/mobile/email split.
     */
    public function initiateSslCommerz(Request $request, SslCommerzGateway $gateway)
    {
        $validated = $request->validate([
            'donation_fund_id' => 'required|exists:donation_funds,id',
            'contact' => 'required_without_all:name,email,mobile_number|string|max:255',
            'name' => 'required_without:contact|string|max:255',
            'mobile_number' => 'required_without:contact|string|max:20',
            'email' => 'required_without:contact|email|max:255',
            'amount' => 'required|numeric|min:100|max:1000000',
            'payment_method' => 'nullable|string|in:sslcommerz,bkash,nagad,rocket,card,bank,manual',
            'terms' => 'required|accepted',
            'project_id' => 'nullable|exists:projects,id',
            'message' => 'nullable|string|max:500',
            'is_anonymous' => 'nullable|boolean',
        ], [
            'donation_fund_id.required' => 'অনুগ্রহ করে একটি ফান্ড নির্বাচন করুন।',
            'contact.required_without_all' => 'ফোন নম্বর বা ইমেইল প্রদান করুন।',
            'name.required_without' => 'নাম আবশ্যক।',
            'mobile_number.required_without' => 'মোবাইল নম্বর আবশ্যক।',
            'email.required_without' => 'ইমেইল আবশ্যক।',
            'amount.required' => 'অনুদানের পরিমাণ আবশ্যক।',
            'amount.min' => 'সর্বনিম্ন অনুদান ১০০ টাকা।',
            'terms.accepted' => 'অনুগ্রহ করে শর্তাবলীতে সম্মতি দিন।',
            'terms.required' => 'অনুগ্রহ করে শর্তাবলীতে সম্মতি দিন।',
        ]);

        // Resolve contact: priority to explicit mobile/email, else parse contact field
        $email = $validated['email'] ?? null;
        $mobile = $validated['mobile_number'] ?? null;
        $name = $validated['name'] ?? null;

        if (!empty($validated['contact'])) {
            $contact = trim($validated['contact']);
            if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
                $email = $email ?: $contact;
            } else {
                // Assume phone: normalize
                $mobile = $mobile ?: $contact;
            }
        }

        // Final validation: at least one contact must be present
        if (empty($email) && empty($mobile)) {
            return back()->withErrors(['contact' => 'ফোন নম্বর বা ইমেইল প্রদান করুন।'])->withInput();
        }

        // If email still empty, synthesize placeholder for donor record (donors.email unique)
        if (empty($email)) {
            $normalizedPhone = preg_replace('/[^0-9]/', '', $mobile);
            $email = 'donor_'.$normalizedPhone.'@placeholder.local';
        }
        if (empty($name)) {
            $name = $email !== 'donor_'.preg_replace('/[^0-9]/','',$mobile).'@placeholder.local' ? explode('@', $email)[0] : 'Donor '.$mobile;
        }
        if (empty($mobile)) {
            $mobile = '00000000000';
        }

        $validated['email'] = $email;
        $validated['mobile_number'] = $mobile;
        $validated['name'] = $name;
        $validated['payment_method'] = $validated['payment_method'] ?? 'sslcommerz';
        $validated['is_anonymous'] = $validated['is_anonymous'] ?? false;

        try {
            $result = null;

            // Create or find the donor
            $donor = Donor::firstOrCreate([
                'email' => $validated['email'],
            ], [
                'mobile_number' => $validated['mobile_number'],
                'name' => $validated['name'],
            ]);

            // Generate unique internal transaction ID: DA-YYYY-NXXXX format
            $internalTransactionId = 'DA-' . date('Y') . '-' . str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);

            // Ensure uniqueness
            while (Donation::where('transaction_id', $internalTransactionId)->exists()) {
                $internalTransactionId = 'DA-' . date('Y') . '-' . str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
            }

            DB::transaction(function () use ($validated, $request, $gateway, $donor, $internalTransactionId, &$result) {
                // Create the donation record
                $donation = Donation::create([
                    'donor_id' => $donor->id,
                    'project_id' => $validated['project_id'],
                    'donation_fund_id' => $validated['donation_fund_id'],
                    'user_id' => $request->user()?->id,
                    'amount' => $validated['amount'],
                    'payment_method' => $validated['payment_method'],
                    'transaction_id' => $internalTransactionId,
                    'status' => 'pending',
                    'message' => $validated['message'],
                    'is_anonymous' => $validated['is_anonymous'] ?? false,
                ]);

                // Create transaction record
                $transaction = Transaction::create([
                    'donation_id' => $donation->id,
                    'user_id' => $request->user()?->id,
                    'gateway' => 'sslcommerz',
                    'gateway_name' => 'sslcommerz',
                    'gateway_session_id' => $internalTransactionId,
                    'status' => 'pending',
                    'transaction_id' => $internalTransactionId,
                    'amount' => $validated['amount'],
                    'currency' => 'BDT',
                    'failure_reason' => null,
                ]);

                // Initialize SSLCommerz payment
                $fundName = $validated['donation_fund_id']
                    ? ($donation->fund?->name_bn ?? $donation->fund?->name_en ?? 'Donation')
                    : 'Donation';
                $paymentData = [
                    'total_amount' => $validated['amount'],
                    'currency' => 'BDT',
                    'tran_id' => $internalTransactionId,
                    'product_category' => 'donation',
                    'product_name' => $fundName,
                    'product_profile' => 'general',
                    'cus_name' => $validated['name'],
                    'cus_email' => $validated['email'],
                    'cus_phone' => $validated['mobile_number'],
                    'cus_country' => 'Bangladesh',
                    'value_a' => $donation->id,
                    'value_b' => $request->user()?->id,
                ];

                $result = $gateway->initialize($paymentData);

                if (!$result['success']) {
                    $donation->update(['status' => 'failed']);
                    $transaction->update([
                        'status' => 'failed',
                        'failure_reason' => $result['message'] ?? 'SSLCommerz initialization failed',
                    ]);
                    throw new \RuntimeException($result['message'] ?? 'Payment initialization failed');
                }

                // Update transaction with SSLCommerz session ID
                $transaction->update([
                    'status' => 'processing',
                    'gateway_session_id' => $result['gateway_session_id'],
                ]);

                // Update donation status
                $donation->update(['status' => 'processing']);
            });

            if (!$result || !$result['success']) {
                return back()->with('error', 'পেমেন্ট আরম্ভ করতে ব্যর্হত হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।')->withInput();
            }

            // Redirect to SSLCommerz payment page
            return redirect($result['redirect_url']);

        } catch (\Throwable $e) {
            Log::error('Donation SSLCommerz initialization failed', [
                'error' => $e->getMessage(),
                'email' => $validated['email'] ?? null,
                'amount' => $validated['amount'] ?? null,
            ]);
            return back()->with('error', 'পেমেন্ট আরম্ভ করতে ব্যর্হত হয়েছে। অনুগ্রহ করে আবার চেষ্টা করুন।')->withInput();
        }
    }

    /**
     * Store a new donation (now creates pending, requires verification - no auto-success).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'amount' => 'required|numeric|min:100|max:1000000',
            'payment_method' => 'required|string|in:sslcommerz,bkash,nagad,rocket,card,bank,manual',
            'donation_fund_id' => 'nullable|exists:donation_funds,id',
            'project_id' => 'nullable|exists:projects,id',
            'message' => 'nullable|string|max:500',
            'is_anonymous' => 'nullable|boolean',
        ]);

        $donationId = null;
        DB::transaction(function () use ($validated, $request, &$donationId) {
            $donor = Donor::firstOrCreate([
                'email' => $validated['email'],
            ], [
                'mobile_number' => $validated['mobile_number'],
                'name' => $validated['name'],
            ]);

            $transactionId = 'DA-' . date('Y') . '-' . str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);

            while (Donation::where('transaction_id', $transactionId)->exists()) {
                $transactionId = 'DA-' . date('Y') . '-' . str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
            }

            $donation = Donation::create([
                'donor_id' => $donor->id,
                'project_id' => $validated['project_id'],
                'donation_fund_id' => $validated['donation_fund_id'],
                'user_id' => $request->user()?->id,
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'transaction_id' => $transactionId,
                'status' => 'pending',
                'message' => $validated['message'],
                'is_anonymous' => $validated['is_anonymous'] ?? false,
            ]);

            Transaction::create([
                'donation_id' => $donation->id,
                'user_id' => $request->user()?->id,
                'gateway' => 'manual',
                'gateway_name' => $validated['payment_method'],
                'gateway_session_id' => $transactionId,
                'status' => 'pending',
                'transaction_id' => $transactionId,
                'amount' => $validated['amount'],
                'currency' => 'BDT',
            ]);

            $donationId = $donation->id;
        });

        return redirect()->route('donation.portal', $donationId)
            ->with('success', 'অনুদান প্রক্রিয়াধীন। পেমেন্ট সম্পন্ন করুন।');
    }

    /**
     * Show payment portal (interstitial before gateway).
     */
    public function portal($id)
    {
        $donation = Donation::with(['donor', 'fund', 'project', 'transaction'])->findOrFail($id);
        return view('front.donation.portal', compact('donation'));
    }

    /**
     * Show fail page.
     */
    public function showFailed($id)
    {
        $donation = Donation::with(['donor', 'fund', 'transaction'])->findOrFail($id);
        return view('front.donation.failed', compact('donation'));
    }

    /**
     * Show cancel page.
     */
    public function showCancelled($id)
    {
        $donation = Donation::with(['donor', 'fund', 'transaction'])->findOrFail($id);
        return view('front.donation.cancelled', compact('donation'));
    }

    /**
     * Display donation success page.
     */
    public function showSuccess($id)
    {
        $donation = Donation::with('donor', 'fund', 'project')->findOrFail($id);
        return view('front.donation.success', compact('donation'));
    }

    /**
     * Generate donation receipt.
     */
    public function receipt($id)
    {
        $donation = Donation::with('donor', 'fund', 'project', 'transaction')->findOrFail($id);

        return view('front.donation.receipt', compact('donation'));
    }

    /**
     * Download donation receipt.
     */
    public function downloadReceipt($id)
    {
        $donation = Donation::with('donor', 'fund', 'project', 'transaction')->findOrFail($id);

        $receiptText = $this->generateReceiptContent($donation);

        $path = tempnam(sys_get_temp_dir(), 'receipt_') . '.txt';
        file_put_contents($path, $receiptText);

        return response()->download(
            $path,
            'dineralo-receipt-' . $donation->transaction_id . '.txt',
            ['Content-Type' => 'text/plain']
        );
    }

    private function generateReceiptContent($donation)
    {
        $output = "========================================\n";
        $output .= "          দিনের আলো\n";
        $output .= "          Donation Receipt\n";
        $output .= "========================================\n\n";

        $output .= "Donor Name: " . ($donation->donor->name ?? 'Anonymous') . "\n";
        $output .= "Donation Category: " . ($donation->fund?->name_en ?? 'General') . "\n";
        $output .= "Amount: " . number_format($donation->amount, 2) . " BDT\n";
        $output .= "Payment Method: " . ucfirst($donation->payment_method) . "\n";
        $output .= "Transaction ID: " . $donation->transaction_id . "\n";
        $output .= "Date/Time: " . $donation->created_at->format('Y-m-d H:i:s') . "\n";
        $output .= "Project/Fund: " . ($donation->project?->title ?? $donation->fund?->name_en) . "\n";
        $output .= "----------------------------------------\n";
        $output .= "দিনের আলো\n";
        $output .= "Humanitarian Organization\n";
        $output .= "========================================\n";

        return $output;
    }
}
