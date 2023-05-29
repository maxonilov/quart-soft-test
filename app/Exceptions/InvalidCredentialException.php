<?php

namespace App\Exceptions;

use Exception;

class InvalidCredentialException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Email or password is invalid.';
}
