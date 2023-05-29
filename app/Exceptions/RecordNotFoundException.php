<?php

namespace App\Exceptions;

use Exception;

class RecordNotFoundException extends Exception
{
    /**
     * @var string
     */
    protected $message = 'Record not found.';
}
