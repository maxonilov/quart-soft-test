<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\Exceptions\InvalidCredentialException;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\Auth\Dto\LoginDto;
use App\Services\Auth\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    private UserRepositoryInterface $userRepository;

    /**
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @inheritdoc
     */
    public function login(LoginDto $dto): string
    {
        if (!$this->isValidCredentials($dto->toArray())) {
            throw new InvalidCredentialException();
        }

        return $this->userRepository->getByEmail($dto->email)
            ->createToken('api')
            ->plainTextToken;
    }

    /**
     * @param array $credentials
     * @return bool
     */
    private function isValidCredentials(array $credentials): bool
    {
        return Auth::attempt($credentials);
    }
}
