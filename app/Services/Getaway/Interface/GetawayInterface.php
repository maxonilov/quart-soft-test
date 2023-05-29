<?php

namespace App\Services\Getaway\Interface;

use App\Exceptions\InvalidStatusException;
use App\Services\Getaway\Dto\CallbackDto;
use App\Services\Getaway\Dto\InvoiceDto;
use App\Services\Getaway\Dto\PayParams;

interface GetawayInterface
{
    /**
     * @param PayParams $params
     * @return InvoiceDto
     */
    public function generateInvoice(PayParams $params): InvoiceDto;

    /**
     * @param array $data
     * @return CallbackDto
     * @throws InvalidStatusException
     */
    public function parseCallback(array $data): CallbackDto;
}
