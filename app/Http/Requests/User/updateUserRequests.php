<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateUserRequests extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pharmacy_name' => ['string'],
            'password' => ['string', 'min:8'],
            'name' => ['string'],
            'phone' => ['string', 'regex:/(09)[0-9]{8}/',Rule::unique('users', 'phone')],
            'address' => ['string'],
            'image' => ['image'],
            'is_admin'=>['boolean']

        ];
    }
}
