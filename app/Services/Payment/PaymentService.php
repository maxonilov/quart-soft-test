<?php

declare(strict_types=1);

namespace App\Services\Payment;

use App\Events\PaymentStatusUpdated;
use App\Exceptions\RecordNotFoundException;
use App\Exceptions\SubscriptionExistException;
use App\Models\Payment;
use App\Models\User;
use App\References\PaymentStatusReference;
use App\Repositories\Payment\PaymentRepositoryInterface;
use App\Repositories\Subscription\SubscriptionRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Getaway\Dto\CallbackDto;
use App\Services\Payment\Dto\CreateDto;
use App\Services\Payment\Dto\PaymentDto;
use App\Services\Payment\Interface\PaymentServiceInterface;

class PaymentService implements PaymentServiceInterface
{
    private UserRepositoryInterface $userRepository;
    private SubscriptionRepositoryInterface $subscriptionRepository;
    private PaymentRepositoryInterface $paymentRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     * @param SubscriptionRepositoryInterface $subscriptionRepository
     * @param PaymentRepositoryInterface $paymentRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        SubscriptionRepositoryInterface $subscriptionRepository,
        PaymentRepositoryInterface $paymentRepository
    ) {
        $this->userRepository = $userRepository;
        $this->subscriptionRepository = $subscriptionRepository;
        $this->paymentRepository = $paymentRepository;
    }

    /**
     * @inheritdoc
     */
    public function create(CreateDto $dto, User $user): Payment
    {
        if ($this->userRepository->hasActiveSubscription($user)) {
            throw new SubscriptionExistException();
        }

        return $this->paymentRepository->create($this->createPaymentDto(
            $dto->paymentMethodId,
            $dto->subscriptionId
        ));
    }

    /**
     * @inheritdoc
     */
    public function update(CallbackDto $dto): Payment
    {
        $payment = $this->paymentRepository->findPendingPayment($dto->paymentId);
        if (!$payment) {
            throw new RecordNotFoundException();
        }
        event(new PaymentStatusUpdated($this->paymentRepository->update($payment, $dto)));

        return $payment;
    }

    /**
     * @param int $paymentMethodId
     * @param int $subscriptionId
     * @return PaymentDto
     */
    private function createPaymentDto(int $paymentMethodId, int $subscriptionId): PaymentDto
    {
        $dto = new PaymentDto();
        $dto->userId = auth()->user()->id;
        $dto->paymentMethodId = $paymentMethodId;
        $dto->subscriptionId = $subscriptionId;
        $dto->sum = (float)$this->subscriptionRepository->getById($subscriptionId)->price;
        $dto->status = PaymentStatusReference::PENDING;

        return $dto;
    }
}
