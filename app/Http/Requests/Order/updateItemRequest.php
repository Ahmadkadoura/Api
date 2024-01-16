<?php

namespace App\Http\Requests\order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class updateItemRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quantity_item' => [ 'min:0'],
            'product_id' => [ Rule::exists('products', 'id')],
            'order_id' => ['required', Rule::exists('orders', 'id')]
        ];
    }
}
