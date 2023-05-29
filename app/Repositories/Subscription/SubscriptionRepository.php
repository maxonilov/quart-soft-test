<?php

namespace App\Repositories\Subscription;

use App\Models\Subscription;

class SubscriptionRepository implements SubscriptionRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function getById(int $id): Subscription
    {
        /** @var Subscription $subscription */
        $subscription = Subscription::query()->findOrFail($id);

        return $subscription;
    }
}
