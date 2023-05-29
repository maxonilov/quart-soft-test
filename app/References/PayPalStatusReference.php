<?php

namespace App\References;

use App\Exceptions\InvalidStatusException;

class PayPalStatusReference
{
    public const PENDING = 1;
    public const PAID = 2;
    public const CANCELED = 3;

    public const PAYMENT_STATUS_MAP = [
        self::PENDING  => PaymentStatusReference::PENDING,
        self::PAID     => PaymentStatusReference::PAID,
        self::CANCELED => PaymentStatusReference::CANCELED,
    ];

    /**
     * @param int $payPalStatus
     * @return mixed
     * @throws InvalidStatusException
     */
    public static function getPaymentStatus(int $payPalStatus): int
    {
        if (!isset(self::PAYMENT_STATUS_MAP[$payPalStatus])) {
            throw new InvalidStatusException();
        }

        return self::PAYMENT_STATUS_MAP[$payPalStatus];
    }
}
