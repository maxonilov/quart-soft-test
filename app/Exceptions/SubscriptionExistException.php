<?php

namespace App\Exceptions;

use Exception;

class SubscriptionExistException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'User already have active subscription.';
}
