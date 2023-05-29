<?php

namespace App\Http\Requests\Api\Payment;

use App\Services\Payment\Dto\CreateDto;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $payment_method_id
 * @property int $subscription_id
 */
class CreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'payment_method_id' => 'required|exists:payment_methods,id',
            'subscription_id'   => 'required|exists:subscriptions,id',
        ];
    }

    /**
     * @return CreateDto
     */
    public function toDto(): CreateDto
    {
        $dto = new CreateDto();
        $dto->subscriptionId = $this->subscription_id;
        $dto->paymentMethodId = $this->payment_method_id;

        return $dto;
    }
}
