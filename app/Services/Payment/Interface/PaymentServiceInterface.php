<?php

namespace App\Services\Payment\Interface;

use App\Exceptions\RecordNotFoundException;
use App\Exceptions\SubscriptionExistException;
use App\Models\Payment;
use App\Models\User;
use App\Services\Getaway\Dto\CallbackDto;
use App\Services\Payment\Dto\CreateDto;

interface PaymentServiceInterface
{
    /**
     * @param CreateDto $dto
     * @param User $user
     * @return Payment
     * @throws SubscriptionExistException
     */
    public function create(CreateDto $dto, User $user): Payment;

    /**
     * @param CallbackDto $dto
     * @return Payment
     * @throws RecordNotFoundException
     */
    public function update(CallbackDto $dto): Payment;
}
