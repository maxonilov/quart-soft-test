<?php

namespace Database\Seeders;

use App\Models\Subscription;
use App\References\SubscriptionStatusReference;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::query()->create([
            'name'             => 'Subscription 1',
            'price'            => 100,
            'articles_allowed' => 3,
            'status'           => SubscriptionStatusReference::ACTIVE,
        ]);
    }
}
