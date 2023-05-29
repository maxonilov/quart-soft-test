<?php

namespace App\Repositories\UserSubscription;

use App\Models\UserSubscription;
use Illuminate\Database\Eloquent\Builder;

class UserSubscriptionRepository implements UserSubscriptionRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function create(array $data): UserSubscription|Builder
    {
      return  UserSubscription::query()->create($data);
    }
}
