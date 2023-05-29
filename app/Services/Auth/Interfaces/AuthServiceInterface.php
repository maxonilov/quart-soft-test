<?php

namespace App\Services\Auth\Interfaces;

use App\Exceptions\InvalidCredentialException;
use App\Services\Auth\Dto\LoginDto;

interface AuthServiceInterface
{
    /**
     * @param LoginDto $dto
     * @return string
     * @throws InvalidCredentialException
     */
    public function login(LoginDto $dto): string;
}
