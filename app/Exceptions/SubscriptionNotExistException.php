<?php

namespace App\Exceptions;

use Exception;

class SubscriptionNotExistException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'User dosen\'t have an active subscription.';
}
