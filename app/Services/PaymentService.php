<?php

namespace App\Services;

use App\Payments\Gateways\SslCommerzGateway;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    protected SslCommerzGateway $sslCommerz;

    public function __construct(SslCommerzGateway $sslCommerz)
    {
        $this->sslCommerz = $sslCommerz;
    }

    /**
     * Process a payment through SSLCommerz.
     *
     * @param array $data
     * @return array
     */
    public function processPayment(array $data = []): array
    {
        try {
            return $this->sslCommerz->initialize($data);
        } catch (\Throwable $e) {
            Log::error('Payment processing failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify a payment through SSLCommerz.
     *
     * @param string $transactionId
     * @param float $amount
     * @param string $currency
     * @param array $postData
     * @return array
     */
    public function verifyPayment(string $transactionId, float $amount = 0, string $currency = 'BDT', array $postData = []): array
    {
        try {
            return $this->sslCommerz->validate($transactionId, $amount, $currency, $postData);
        } catch (\Throwable $e) {
            Log::error('Payment verification failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
