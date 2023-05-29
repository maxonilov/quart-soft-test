<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;

class UserActiveSubscription extends UserSubscription
{
    /**
     * @var string
     */
    protected $table = 'user_subscriptions';

    /**
     * @return void
     */
    protected static function booted(): void
    {
        parent::booted();
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('from_date', '<=', now())
                ->where('to_date', '>=', now())
                ->where('articles_available', '!=', '0');
        });
    }
}
