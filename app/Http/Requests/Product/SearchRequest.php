<?php

namespace App\Http\Requests\product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'scientific_name' => ['string'],
            'trading_name' => ['required','string' ,Rule::exists('products', 'trading_name')],
            'date_of_validity' => ['date', 'after:today'],
            'manufacturer' => ['string'],
            'price' => ['int'],
            'available_quantity' => ['int', 'min:0'],
            'Category_id' => [ Rule::exists('categories', 'id')],
            'image' => ['image'],
        ];
    }
}
