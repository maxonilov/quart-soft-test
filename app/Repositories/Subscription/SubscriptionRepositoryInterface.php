<?php

namespace App\Repositories\Subscription;

use App\Models\Subscription;

interface SubscriptionRepositoryInterface
{
    /**
     * @param int $id
     * @return Subscription
     */
    public function getById(int $id): Subscription;
}
