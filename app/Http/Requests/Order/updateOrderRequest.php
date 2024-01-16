<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateOrderRequest extends FormRequest
{
    
   
    public function rules(): array
    {
        return [
            'orderItems' => [
                'array',
            ],
            'orderItems.*.id' => [
                Rule::exists('products', 'id'),
            ],
            'orderItems.*.quantity' => [
                 'numeric', 'min:1',
            ],
            'order_status'=>[
                'string'
                ]
        ];
    }
}
