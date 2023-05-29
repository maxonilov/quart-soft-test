<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $user_subscription_id
 * @property string $title
 * @property string $text
 * @property int $status
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property UserSubscription $subscription
 */
class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_subscription_id',
        'title',
        'text',
        'status',
    ];

    protected static function booted()
    {
        static::created(function (self $article) {
            $article->userSubscription()->decrement('articles_available');
        });
    }

    /**
     * @return HasOne
     */
    public function userSubscription(): HasOne
    {
        return $this->hasOne(UserSubscription::class, 'id', 'user_subscription_id');
    }
}
