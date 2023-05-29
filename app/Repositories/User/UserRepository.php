<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\UserSubscription;
use Illuminate\Database\Eloquent\Builder;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritdoc
     */
    public function getByEmail(string $email): User|Builder
    {
        return User::query()->where('email', $email)->first();
    }

    /**
     * @inheritdoc
     */
    public function hasActiveSubscription(User $user): bool
    {
        return (boolean)$user->activeSubscriptions()->count();
    }

    /**
     * @inheritdoc
     */
    public function getActiveSubscription(User $user): ?UserSubscription
    {
        /** @var UserSubscription|null $subscription */
        $subscription = $user->activeSubscriptions()->first();

        return $subscription;
    }
}
