<?php

namespace App\Services\Payment\Dto;

class PaymentDto
{
    public int $userId;
    public int $subscriptionId;
    public int $paymentMethodId;
    public float|int $sum;
    public int $status;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'user_id'           => $this->userId,
            'subscription_id'   => $this->subscriptionId,
            'payment_method_id' => $this->paymentMethodId,
            'sum'               => $this->sum,
            'status'            => $this->status
        ];
    }
}
