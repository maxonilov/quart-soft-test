<?php

namespace App\Models;

use App\Events\PaymentCreating;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property int $user_id
 * @property int $payment_method_id
 * @property int $subscription_id
 * @property string $pay_url
 * @property string $qr_pay_url
 * @property string $payment_id
 * @property float $sum
 * @property int $status
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 * @property User $user
 * @property PaymentMethod $paymentMethod
 * @property Subscription $subscription
 */
class Payment extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'payment_method_id',
        'subscription_id',
        'pay_url',
        'qr_pay_url',
        'payment_id',
        'sum',
        'status',
    ];

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::creating(function (self $payment) {
            event(new PaymentCreating($payment));
        });
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    /**
     * @return HasOne
     */
    public function paymentMethod(): HasOne
    {
        return $this->hasOne(PaymentMethod::class, 'id', 'payment_method_id');
    }

    /**
     * @return HasOne
     */
    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class, 'id', 'subscription_id');
    }
}
