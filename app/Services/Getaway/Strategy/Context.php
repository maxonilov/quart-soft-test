<?php

namespace App\Services\Getaway\Strategy;

use App\Exceptions\InvalidPaymentMethodException;
use App\Models\PaymentMethod;
use App\References\PaymentMethodReference;
use App\Services\Getaway\Api\PayPalApi;
use App\Services\Getaway\Api\UaPayApi;
use App\Services\Getaway\Interface\GetawayInterface;
use App\Services\Getaway\PayPal;
use App\Services\Getaway\UaPay;

class Context
{
    public GetawayInterface $getaway;

    /**
     * @param PaymentMethod $paymentMethod
     * @return $this
     * @throws InvalidPaymentMethodException
     */
    public function setGetawayByPaymentMethod(PaymentMethod $paymentMethod): self
    {
        $this->getaway = match ($paymentMethod->id) {
            PaymentMethodReference::UA_PAY => new UaPay(new UaPayApi()),
            PaymentMethodReference::PAY_PAL => new PayPal(new PayPalApi()),
            default => throw new InvalidPaymentMethodException(),
        };

        return $this;
    }

    /**
     * @return GetawayInterface
     */
    public function getGetaway(): GetawayInterface
    {
        return $this->getaway;
    }
}
