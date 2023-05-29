<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\References\PaymentMethodStatusReference;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::query()->create([
            'name'         => 'UAPay',
            'client_id'    => 'client id',
            'api_base_url' => 'https://uapay.ua/api/',
            'callback_url' => 'http://localhost:8080/payments/callback/1',
            'status'       => PaymentMethodStatusReference::ACTIVE
        ]);
        PaymentMethod::query()->create([
            'name'          => 'PayPal',
            'client_id'     => 'client id',
            'client_secret' => 'client secret',
            'callback_url'  => 'http://localhost:8080/payments/callback/2',
            'api_base_url'  => 'https://api-m.sandbox.paypal.com/',
            'status'        => PaymentMethodStatusReference::ACTIVE
        ]);
    }
}
