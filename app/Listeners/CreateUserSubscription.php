<?php

namespace App\Listeners;

use App\Events\PaymentStatusUpdated;
use App\Models\Payment;
use App\References\PaymentStatusReference;
use App\Repositories\UserSubscription\UserSubscriptionRepositoryInterface;

class CreateUserSubscription
{
    private UserSubscriptionRepositoryInterface $repository;

    /**
     * Create the event listener.
     */
    public function __construct(UserSubscriptionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     */
    public function handle(PaymentStatusUpdated $event): void
    {
        if ($event->payment->status === PaymentStatusReference::PAID) {
            $this->repository->create(
                $this->createUserSubscriptionData($event->payment)
            );
        }
    }

    /**
     * @param Payment $payment
     * @return array
     */
    private function createUserSubscriptionData(Payment $payment): array
    {
        return [
            'user_id'            => $payment->user_id,
            'subscription_id'    => $payment->subscription_id,
            'payment_id'         => $payment->id,
            'articles_allowed'   => $payment->subscription->articles_allowed,
            'articles_available' => $payment->subscription->articles_allowed,
            'from_date'          => now(),
            'to_date'            => now()->addMonth()
        ];
    }
}
