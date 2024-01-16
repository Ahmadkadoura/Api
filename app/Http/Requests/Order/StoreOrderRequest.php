<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'orderItems' => [
                'required',
                'array',
            ],
            'orderItems.*.id' => [
                'required',
                Rule::exists('products', 'id'),
            ],
            'orderItems.*.quantity' => [
                'required', 'numeric', 'min:1',
            ],

            
        ];
    }
}
