<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * @property int $id
 * @property int $user_id
 * @property int $payment_id
 * @property int $subscription_id
 * @property int $articles_available
 * @property int $articles_allowed
 * @property CarbonInterface $from_date
 * @property CarbonInterface $to_date
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property User $user
 * @property Payment $payment
 * @property Subscription $subscription
 */
class UserSubscription extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'subscription_id',
        'payment_id',
        'articles_available',
        'articles_allowed',
        'from_date',
        'to_date',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'from_date' => 'datetime',
        'to_date'   => 'datetime',
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * @return HasOne
     */
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class,'id', 'subscription_id');
    }

    /**
     * @return HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class, 'id', 'payment_id');
    }
}
