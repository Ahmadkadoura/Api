<?php

namespace App\Http\Requests\product;

use App\Models\product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FavoriteRequest extends FormRequest
{
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'product_id' => ['required', Rule::exists('products', 'id')],
        ];
    }
}
