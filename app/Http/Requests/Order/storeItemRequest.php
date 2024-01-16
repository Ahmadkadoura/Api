<?php

namespace App\Http\Requests\order;

use App\Models\product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class storeItemRequest extends FormRequest
{

    // public function validationData()
    // {
    //     $data = $this->all();

    //     $product = product::all($data['product_id']);

    //     $data['product'] = $product;

    //     return $data;
    // }
    public function rules(): array
    {
        return [
            'quantity_item' => ['required', 'min:0'],
            'product_id' => ['required', Rule::exists('products', 'id')],
        ];
    }
}
