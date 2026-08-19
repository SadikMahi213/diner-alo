<?php

namespace App\Payments\Gateways;

use App\Payments\Contracts\PaymentGatewayInterface;
use App\Payments\DTOs\PaymentResult;
use App\Payments\Exceptions\PaymentException;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SslCommerzGateway implements PaymentGatewayInterface
{
    protected SslCommerzNotification $sslc;

    protected bool $isTestMode;

    public function __construct()
    {
        $this->sslc = new SslCommerzNotification();
        $this->isTestMode = config('sslcommerz.connect_from_localhost', false);
    }

    /**
     * Initialize SSLCommerz payment session.
     *
     * @param array $data {
     *     @var float $total_amount
     *     @var string $tran_id
     *     @var string $product_category
     *     @var string $cus_name
     *     @var string $cus_email
     *     @var string $cus_phone
     *     @var string|null $cus_add1
     *     @var string|null $cus_city
     *     @var string|null $cus_country
     *     @var string|null $product_name
     *     @var string|null $product_profile
     *     @var string|null $value_a (metadata: donation_id or order_id)
     *     @var string|null $value_b (metadata: user_id)
     * }
     * @return array
     */
    public function initialize(array $data): array
    {
        $totalAmount = (float) $data['total_amount'];
        $tranId = $data['tran_id'] ?? Str::uuid()->toString();
        $currency = $data['currency'] ?? 'BDT';

        $item = [
            'total_amount' => $totalAmount,
            'currency' => $currency,
            'tran_id' => $tranId,
            'product_category' => $data['product_category'] ?? 'donation',
            'product_name' => $data['product_name'] ?? ($data['product_category'] ?? 'donation'),
            'product_profile' => $data['product_profile'] ?? 'general',
            'cus_name' => $data['cus_name'] ?? null,
            'cus_email' => $data['cus_email'] ?? null,
            'cus_add1' => $data['cus_add1'] ?? null,
            'cus_city' => $data['cus_city'] ?? null,
            'cus_country' => $data['cus_country'] ?? 'Bangladesh',
            'cus_phone' => $data['cus_phone'] ?? null,
            'shipping_method' => 'NO',
            'num_of_item' => 1,
            'value_a' => $data['value_a'] ?? null,
            'value_b' => $data['value_b'] ?? null,
        ];

        $response = $this->sslc->makePayment($item, 'checkout', 'json');
        $result = json_decode($response, true);

        if (!is_array($result) || !isset($result['status'])) {
            throw new PaymentException(
                'Invalid response from SSLCommerz gateway',
                ['raw_response' => $response]
            );
        }

        if ($result['status'] !== 'success' && $result['status'] !== 'SUCCESS') {
            $message = $result['message'] ?? $result['failedreason'] ?? 'SSLCommerz payment initialization failed';
            throw new PaymentException($message, ['response' => $result]);
        }

        $redirectUrl = $result['data'] ?? ($result['GatewayPageURL'] ?? null);

        if (empty($redirectUrl)) {
            throw new PaymentException(
                'No redirect URL provided by SSLCommerz',
                ['response' => $result]
            );
        }

        Log::info('SSLCommerz payment initialized', [
            'tran_id' => $tranId,
            'amount' => $totalAmount,
            'currency' => $currency,
            'is_test' => $this->isTestMode,
        ]);

        return [
            'success' => true,
            'gateway' => 'sslcommerz',
            'gateway_session_id' => $tranId,
            'redirect_url' => $redirectUrl,
            'amount' => $totalAmount,
            'currency' => $currency,
            'status' => 'pending',
        ];
    }

    /**
     * Validate/verify an SSLCommerz transaction.
     *
     * @param string $transactionId
     * @param float $amount
     * @param string $currency
     * @param array $postData
     * @return array
     */
    public function validate(string $transactionId, float $amount, string $currency = 'BDT', array $postData = []): array
    {
        try {
            $validation = $this->sslc->orderValidate($postData, $transactionId, $amount, $currency);

            if (!$validation) {
                $error = $this->getLastError();
                return [
                    'success' => false,
                    'gateway' => 'sslcommerz',
                    'status' => 'failed',
                    'message' => $error ?: 'SSLCommerz validation failed',
                    'amount' => $amount,
                    'currency' => $currency,
                ];
            }

            $validatedAmount = (float) ($postData['amount'] ?? $amount);
            $validatedCurrency = $postData['currency'] ?? $currency;

            if (abs($validatedAmount - $amount) > 0.01) {
                Log::warning('SSLCommerz amount mismatch', [
                    'expected' => $amount,
                    'received' => $validatedAmount,
                    'tran_id' => $transactionId,
                ]);
                return [
                    'success' => false,
                    'gateway' => 'sslcommerz',
                    'status' => 'failed',
                    'message' => 'Amount mismatch detected',
                    'amount' => $validatedAmount,
                    'currency' => $validatedCurrency,
                ];
            }

            return [
                'success' => true,
                'gateway' => 'sslcommerz',
                'gateway_transaction_id' => $postData['bank_tran_id'] ?? $postData['sslcommerz_tran_id'] ?? $transactionId,
                'amount' => $validatedAmount,
                'currency' => $validatedCurrency,
                'status' => 'paid',
            ];
        } catch (\Throwable $e) {
            Log::error('SSLCommerz validation error', [
                'error' => $e->getMessage(),
                'tran_id' => $transactionId,
            ]);
            return [
                'success' => false,
                'gateway' => 'sslcommerz',
                'status' => 'failed',
                'message' => $e->getMessage(),
                'amount' => $amount,
                'currency' => $currency,
            ];
        }
    }

    /**
     * Get the error message from SSLCommerz.
     */
    protected function getLastError(): ?string
    {
        $reflection = new \ReflectionClass($this->sslc);
        if ($reflection->hasProperty('error')) {
            $prop = $reflection->getProperty('error');
            $prop->setAccessible(true);
            return $prop->getValue($this->sslc);
        }
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return 'sslcommerz';
    }
}
