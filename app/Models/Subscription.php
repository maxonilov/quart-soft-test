<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $price
 * @property int $articles_allowed
 * @property int $status
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 */
class Subscription extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'price',
        'articles_allowed',
        'status',
    ];
}
