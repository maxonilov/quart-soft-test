<?php

declare(strict_types=1);

namespace App\Services\Getaway;

use App\References\UaPayStatusReference;
use App\Services\Getaway\Abstract\AbstractGetaway;
use App\Services\Getaway\Api\UaPayApi;
use App\Services\Getaway\Dto\CallbackDto;
use App\Services\Getaway\Dto\InvoiceDto;
use App\Services\Getaway\Dto\PayParams;
use App\Services\Getaway\Interface\GetawayInterface;

class UaPay extends AbstractGetaway implements GetawayInterface
{
    private UaPayApi $api;

    /**
     * @param UaPayApi $api
     */
    public function __construct(UaPayApi $api)
    {
        $this->api = $api;
    }

    /**
     * @inheritdoc
     */
    public function generateInvoice(PayParams $params): InvoiceDto
    {
        $invoice = $this->api->createInvoice(
            $this->api->createSession($params->clientId)['id'],
            $params->sum,
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
            $data['payment_id'],
            UaPayStatusReference::getPaymentStatus((int)$data['status'])
        );
    }
}
