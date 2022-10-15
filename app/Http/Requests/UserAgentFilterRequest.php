<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserAgentFilterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'quantity' => ['int' ,'digits_between:1,1000'],
            'device' => ['string' , Rule::in(['desktop', 'mobile', 'tablet'])],
        ];
    }
}
