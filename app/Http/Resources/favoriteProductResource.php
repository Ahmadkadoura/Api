<?php

namespace App\Http\Resources;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class favoriteProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
    return
         [
        'id' => $this->id,
        'product_id'=>$this->product-> id,
        'is_favorite'=>$this->is_favorite,
        'trading_name' => $this->product->trading_name,
         'price' => (number_format($this->product->price ).' sp'),
        'category' => new CategoryResource($this->product->category),
        'image' => $this->product->image,
         ];
    }
}
