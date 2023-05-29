<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidCredentialException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Services\Auth\Interfaces\AuthServiceInterface;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param AuthServiceInterface $service
     * @return Response
     */
    public function login(
        LoginRequest $request,
        AuthServiceInterface $service
    ): Response {
        try {
            return new Response(['token' => $service->login($request->toDto())]);
        } catch (InvalidCredentialException $exception) {
            throw new UnauthorizedHttpException($exception->getMessage());
        }
    }
}
