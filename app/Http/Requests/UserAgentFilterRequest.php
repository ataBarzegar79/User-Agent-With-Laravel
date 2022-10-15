<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @property mixed $device
 * @property mixed $quantity
 */
class UserAgentFilterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    #[ArrayShape(['quantity' => "string[]", 'device' => "array"])]
    public function rules(): array
    {
        return [
            'quantity' => ['int', 'gte:1', "lte:1000"],
            'device' => ['string', Rule::in(['desktop', 'mobile', 'tablet'])],
        ];
    }
}
