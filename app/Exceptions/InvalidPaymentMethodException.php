<?php

namespace App\Exceptions;

use Exception;

class InvalidPaymentMethodException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Invalid payment method.';
}
