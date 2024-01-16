<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorProductRequests extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'scientific_name' => ['required', 'string'],
            'trading_name' => ['required','string' ,Rule::unique('products', 'trading_name')],
            'date_of_validity' => ['required', 'date', 'after:today'],
            'manufacturer' => ['required', 'string'],
            'price' => ['required', 'int'],
            'quantity' => ['required', 'min:0'],
            'Category_id' => ['required', Rule::exists('categories', 'id')],
            'image' => ['image'],
            
        ];
    }
}
