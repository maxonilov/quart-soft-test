<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\InvalidPaymentMethodException;
use App\Exceptions\InvalidStatusException;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Services\Getaway\Dto\CallbackDto;
use App\Services\Getaway\Dto\InvoiceDto;
use App\Services\Getaway\Dto\PayParams;
use App\Services\Getaway\Interface\GetawayInterface;
use App\Services\Getaway\Strategy\Context;

class Getaway
{
    private Context $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    /**
     * @param Payment $payment
     * @return InvoiceDto
     * @throws InvalidPaymentMethodException
     */
    public function pay(Payment $payment): InvoiceDto
    {
        return $this->getGetaway($payment->paymentMethod)->generateInvoice(
            $this->createPayParams($payment)
        );
    }

    /**
     * @param PaymentMethod $method
     * @param array $data
     * @return CallbackDto
     * @throws InvalidPaymentMethodException
     * @throws InvalidStatusException
     */
    public function callback(PaymentMethod $method, array $data): CallbackDto
    {
        return $this->getGetaway($method)->parseCallback($data);
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @return GetawayInterface
     * @throws InvalidPaymentMethodException
     */
    private function getGetaway(PaymentMethod $paymentMethod): GetawayInterface
    {
        return $this->context->setGetawayByPaymentMethod($paymentMethod)->getGetaway();
    }

    /**
     * @param Payment $payment
     * @return PayParams
     */
    private function createPayParams(Payment $payment): PayParams
    {
        $dto = new PayParams();
        $dto->sum = $payment->sum;
        $dto->clientId = $payment->paymentMethod->client_id;
        $dto->clientSecret = $payment->paymentMethod->client_secret;

        return $dto;
    }
}
