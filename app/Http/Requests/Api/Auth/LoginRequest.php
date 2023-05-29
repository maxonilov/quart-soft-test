<?php

namespace App\Http\Requests\Api\Auth;

use App\Services\Auth\Dto\LoginDto;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $password
 * @property string $email
 */
class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required|between:8,24',
        ];
    }

    /**
     * @return LoginDto
     */
    public function toDto(): LoginDto
    {
        $dto = new LoginDto();
        $dto->email = $this->email;
        $dto->password = $this->password;

        return $dto;
    }
}
