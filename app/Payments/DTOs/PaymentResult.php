<?php

namespace App\Payments\DTOs;

class PaymentResult
{
    public function __construct(
        public readonly bool $success,
        public readonly string $gateway,
        public readonly ?string $gatewayTransactionId = null,
        public readonly ?string $gatewaySessionId = null,
        public readonly ?string $redirectUrl = null,
        public readonly float $amount = 0.0,
        public readonly string $currency = 'BDT',
        public readonly string $status = 'pending',
        public readonly ?string $message = null,
        public readonly ?array $rawResponse = null,
    ) {}

    /**
     * Create from an array.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            success: $data['success'] ?? false,
            gateway: $data['gateway'] ?? '',
            gatewayTransactionId: $data['gateway_transaction_id'] ?? null,
            gatewaySessionId: $data['gateway_session_id'] ?? null,
            redirectUrl: $data['redirect_url'] ?? null,
            amount: $data['amount'] ?? 0.0,
            currency: $data['currency'] ?? 'BDT',
            status: $data['status'] ?? 'pending',
            message: $data['message'] ?? null,
            rawResponse: $data['raw_response'] ?? null,
        );
    }

    /**
     * Convert to array.
     */
    public function toArray(): array
    {
        return [
            'success' => $this->success,
            'gateway' => $this->gateway,
            'gateway_transaction_id' => $this->gatewayTransactionId,
            'gateway_session_id' => $this->gatewaySessionId,
            'redirect_url' => $this->redirectUrl,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'status' => $this->status,
            'message' => $this->message,
            'raw_response' => $this->rawResponse,
        ];
    }
}
