<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\InvalidPaymentMethodException;
use App\Exceptions\InvalidStatusException;
use App\Exceptions\RecordNotFoundException;
use App\Exceptions\SubscriptionExistException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Payment\CreateRequest;
use App\Http\Resources\Api\PaymentResource;
use App\Models\PaymentMethod;
use App\Services\Getaway;
use App\Services\Payment\Interface\PaymentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class PaymentController extends Controller
{
    private PaymentServiceInterface $service;

    /**
     * @param PaymentServiceInterface $service
     */
    public function __construct(PaymentServiceInterface $service
    ) {
        $this->service = $service;
    }

    /**
     * @param CreateRequest $request
     * @return PaymentResource
     */
    public function pay(
        CreateRequest $request,
    ): PaymentResource {
        try {
            return PaymentResource::make(
                $this->service->create($request->toDto(), auth()->user())
            );
        } catch (SubscriptionExistException $e) {
            throw new AccessDeniedHttpException($e->getMessage());
        }
    }

    /**
     * @param PaymentMethod $paymentMethod
     * @param Request $request
     * @param Getaway $getaway
     * @return Response
     */
    public function callback(
        PaymentMethod $paymentMethod,
        Request $request,
        Getaway $getaway
    ): Response {
        try {
            $this->service->update(
                $getaway->callback($paymentMethod, $request->all())
            );

            return new Response(['message' => 'success']);
        } catch (InvalidPaymentMethodException|RecordNotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage());
        } catch (InvalidStatusException $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
