<?php

namespace App\Services\Getaway\Abstract;

use App\Services\Getaway\Dto\CallbackDto;
use App\Services\Getaway\Dto\InvoiceDto;

abstract class AbstractGetaway
{
    /**
     * @param string $paymentId
     * @param string $payUrl
     * @param string|null $qrPayUrl
     * @return InvoiceDto
     */
    protected function createInvoiceDto(string $paymentId, string $payUrl, string $qrPayUrl = null): InvoiceDto
    {
        $dto = new InvoiceDto();
        $dto->paymentId = $paymentId;
        $dto->payUrl = $payUrl;
        $dto->qrPayUrl = $qrPayUrl;

        return $dto;
    }

    /**
     * @param string $paymentId
     * @param int $status
     * @return CallbackDto
     */
    protected function createCallbackDto(string $paymentId, int $status): CallbackDto
    {
        $dto = new CallbackDto();
        $dto->paymentId = $paymentId;
        $dto->status = $status;

        return $dto;
    }
}
