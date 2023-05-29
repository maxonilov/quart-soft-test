<?php

namespace App\Exceptions;

use Exception;

class InvalidStatusException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Invalid status id.';
}
