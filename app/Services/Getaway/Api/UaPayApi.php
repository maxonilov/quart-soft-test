<?php

namespace App\Services\Getaway\Api;

class UaPayApi
{
    /**
     * POST CURL /api/sessions/create using api_base_url & client_id
     * @param string $clientId
     * @return array
     */
    public function createSession(string $clientId): array
    {
        return [
            'status' => 1,
            'id'     => 'id',
        ];
    }

    /**
     * POST CURL api/invoicer/invoices/create using api_base_url, callback_url, session_id
     * @param string $sessionId
     * @param float $sum
     * @return array
     */
    public function createInvoice(string $sessionId, float $sum): array
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
