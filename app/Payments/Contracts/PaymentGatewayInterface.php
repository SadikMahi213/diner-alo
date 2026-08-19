<?php

namespace App\Payments\Contracts;

interface PaymentGatewayInterface
{
    /**
     * Initialize a payment with the gateway.
     *
     * @param array $data Payment initialization data.
     * @return array{
     *   success: bool,
     *   gateway: string,
     *   gateway_session_id?: string,
     *   redirect_url?: string,
     *   message?: string
     * }
     */
    public function initialize(array $data): array;

    /**
     * Verify a payment with the gateway.
     *
     * @param string $transactionId
     * @param float $amount
     * @param string $currency
     * @param array $postData
     * @return array{
     *   success: bool,
     *   gateway: string,
     *   gateway_transaction_id?: string,
     *   amount: float,
     *   currency: string,
     *   status: string,
     *   message?: string
     * }
     */
    public function validate(string $transactionId, float $amount, string $currency, array $postData = []): array;

    /**
     * Get the gateway name.
     *
     * @return string
     */
    public function getName(): string;
}
