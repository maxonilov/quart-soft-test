<?php

namespace App\Repositories\Payment;

use App\Models\Payment;
use App\Services\Payment\Dto\PaymentDto;
use Illuminate\Database\Eloquent\Builder;

interface PaymentRepositoryInterface
{
    /**
     * @param PaymentDto $dto
     * @return Payment
     */
    public function create(PaymentDto $dto): Payment;

    /**
     * @param string $paymentId
     * @return Payment|Builder|null
     */
    public function findPendingPayment(string $paymentId): Payment|Builder|null;
}
