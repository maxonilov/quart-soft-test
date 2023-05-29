<?php

namespace App\Repositories\Payment;

use App\Models\Payment;
use App\References\PaymentStatusReference;
use App\Services\Getaway\Dto\CallbackDto;
use App\Services\Payment\Dto\PaymentDto;
use Illuminate\Database\Eloquent\Builder;

class PaymentRepository implements PaymentRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(PaymentDto $dto): Payment
    {
        /** @var Payment $payment */
        $payment = Payment::query()->create($dto->toArray());

        return $payment;
    }

    /**
     * @param Payment $payment
     * @param CallbackDto $dto
     * @return Payment
     */
    public function update(Payment $payment, CallbackDto $dto): Payment
    {
        $payment->update($dto->toArray());

        return $payment;
    }

    /**
     * @inheritdoc
     */
    public function findPendingPayment(string $paymentId): Payment|Builder|null
    {
        return Payment::query()->where('payment_id', $paymentId)
            ->where('status', PaymentStatusReference::PENDING)
            ->first();
    }
}
