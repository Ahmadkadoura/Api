<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorUserRequests extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pharmacy_name' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
            'name' => ['required', 'string'],
            'phone' => ['required', 'string', 'regex:/(09)[0-9]{8}/',Rule::unique('users', 'phone')],
            'address' => ['required', 'string'],
            'image' => [ 'image' , 'mimes:jpeg,jpg,png,gif'],
            'is_admin'=>['boolean']


        ];
    }
}
