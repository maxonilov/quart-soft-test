<?php

namespace App\Services\Getaway\Dto;

class CallbackDto
{
    public string $paymentId;
    public int $status;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'payment_id' => $this->paymentId,
            'status'     => $this->status
        ];
    }
}
