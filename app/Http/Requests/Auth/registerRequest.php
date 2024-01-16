<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class registerRequest extends FormRequest
{

    
    public function rules(): array
    {
        return [
            'pharmacy_name' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
            'name' => ['required', 'string'],
            'phone' => ['required', 'string', 'regex:/(09)[0-9]{8}/',Rule::unique('users', 'phone')],
            'address' => ['required', 'string'],
        ];
    }
}
