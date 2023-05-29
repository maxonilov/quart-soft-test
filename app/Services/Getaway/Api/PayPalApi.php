<?php

namespace App\Services\Getaway\Api;

class PayPalApi
{
    /**
     * POST CURL https://api-m.sandbox.paypal.com/v1/oauth2/token using client_id, client_secret
     * @return string[]
     */
    public function auth(string $clientId, string $clientSecret): array
    {
        return [
            'access_token' => 'access_token',
        ];
    }

    /**
     * @param string $token
     * @param float $sum
     * @return array
     */
    public function initialPayment(string $token, float $sum): array
    {
        return [
            'status' => 1,
            'data'   => [
                'id'               => 'id',
                'paymentPageUrl'   => 'paymentPageUrl',
                'paymentPageUrlQR' => 'paymentPageUrlQR',
            ]
        ];
    }
}
