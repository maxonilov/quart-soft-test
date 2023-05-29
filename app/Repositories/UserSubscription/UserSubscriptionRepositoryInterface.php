<?php

namespace App\Repositories\UserSubscription;

use App\Models\UserSubscription;
use Illuminate\Database\Eloquent\Builder;

interface UserSubscriptionRepositoryInterface
{
    /**
     * @param array $data
     * @return UserSubscription|Builder
     */
    public function create(array $data): UserSubscription|Builder;
}
