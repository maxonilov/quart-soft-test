<?php

namespace App\Services\Getaway\Dto;

class PayParams
{
    public string $clientId;
    public string|null $clientSecret;
    public float $sum;
}
