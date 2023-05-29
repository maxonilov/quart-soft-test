<?php

namespace App\Listeners;

use App\Events\PaymentCreating;
use App\Exceptions\InvalidPaymentMethodException;
use App\Models\Payment;
use App\Services\Getaway;
use App\Services\Getaway\Dto\InvoiceDto;

class GenerateGetawayData
{
    private Getaway $getaway;

    public function __construct(Getaway $getaway)
    {
        $this->getaway = $getaway;
    }

    /**
     * @param PaymentCreating $event
     * @return void
     * @throws InvalidPaymentMethodException
     */
    public function handle(PaymentCreating $event): void
    {
        $this->setGetawayParams(
            $event->payment,
            $this->getaway->pay($event->payment)
        );
    }

    /**
     * @param Payment $payment
     * @param InvoiceDto $dto
     * @return void
     */
    private function setGetawayParams(Payment $payment, InvoiceDto $dto): void
    {
        $payment->pay_url = $dto->payUrl;
        $payment->qr_pay_url = $dto->qrPayUrl;
        $payment->payment_id = $dto->paymentId;
    }
}
