<?php

declare(strict_types=1);

namespace App\Services\Getaway;

use App\References\PayPalStatusReference;
use App\Services\Getaway\Abstract\AbstractGetaway;
use App\Services\Getaway\Api\PayPalApi;
use App\Services\Getaway\Dto\CallbackDto;
use App\Services\Getaway\Dto\InvoiceDto;
use App\Services\Getaway\Dto\PayParams;
use App\Services\Getaway\Interface\GetawayInterface;

class PayPal extends AbstractGetaway implements GetawayInterface
{
    private PayPalApi $api;

    /**
     * @param PayPalApi $api
     */
    public function __construct(PayPalApi $api)
    {
        $this->api = $api;
    }

    /**
     * @inheritdoc
     */
    public function generateInvoice(PayParams $params): InvoiceDto
    {
        $invoice = $this->api->initialPayment(
            $this->api->auth(
                $params->clientId,
                $params->clientSecret
            )['access_token'],
            $params->sum
        );

        return $this->createInvoiceDto(
            $invoice['data']['id'],
            $invoice['data']['paymentPageUrl'],
            $invoice['data']['paymentPageUrlQR'],
        );
    }

    /**
     * @inheritdoc
     */
    public function parseCallback(array $data): CallbackDto
    {
        return $this->createCallbackDto(
            $data['data']['id'],
            PayPalStatusReference::getPaymentStatus((int)$data['data']['status'])
        );
    }
}
