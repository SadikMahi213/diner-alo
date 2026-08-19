<?php

namespace App\Payments\Exceptions;

use Exception;

class PaymentException extends Exception
{
    /**
     * The payment data associated with the exception.
     *
     * @var array
     */
    protected array $paymentData = [];

    /**
     * Create a new payment exception instance.
     *
     * @param string $message
     * @param array $paymentData
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(
        string $message = '',
        array $paymentData = [],
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        $this->paymentData = $paymentData;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the payment data.
     *
     * @return array
     */
    public function getPaymentData(): array
    {
        return $this->paymentData;
    }
}
