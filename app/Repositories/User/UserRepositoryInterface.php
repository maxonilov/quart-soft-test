<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Database\Eloquent\Builder;

interface UserRepositoryInterface
{
    /**
     * @param string $email
     * @return User|Builder
     */
    public function getByEmail(string $email): User|Builder;

    /**
     * @param User $user
     * @return bool
     */
    public function hasActiveSubscription(User $user): bool;

    /**
     * @param User $user
     * @return UserSubscription|null
     */
    public function getActiveSubscription(User $user): ?UserSubscription;
}
