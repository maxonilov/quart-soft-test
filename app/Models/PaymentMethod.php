<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $client_id
 * @property string|null $client_secret
 * @property string $api_base_url
 * @property string $callback_url
 * @property int $status
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
class PaymentMethod extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'api_base_url',
        'callback_url',
        'client_id',
        'client_secret',
        'status',
    ];
}
