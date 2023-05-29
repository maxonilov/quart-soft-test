<?php

namespace App\Http\Requests\Api\Article;

use App\Services\Article\Dto\CreateDto;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $title
 * @property string $text
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
            'title' => 'required|max:255',
            'text'  => 'required|max:65000',
        ];
    }

    /**
     * @return CreateDto
     */
    public function toDto(): CreateDto
    {
        $dto = new CreateDto();
        $dto->title = $this->title;
        $dto->text = $this->text;

        return $dto;
    }
}
