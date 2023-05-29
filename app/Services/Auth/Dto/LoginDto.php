<?php

namespace App\Services\Auth\Dto;

class LoginDto
{
    public string $email;
    public string $password;

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return [
            'email'    => $this->email,
            'password' => $this->password
        ];
    }
}
