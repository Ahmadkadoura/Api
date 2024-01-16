<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecentlyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'scientific_name' => $this->scientific_name,
            'trading_name' => $this->trading_name,
            'manufacturer' => $this->manufacturer,
            'Date_of_validity' => $this->date_of_validity,
            'quantity' => $this->quantity,
            'price' => (number_format($this->price) . ' sp'),
            'image' => $this->image,
            'category' => new CategoryResource($this->category),
        ];
    }
}
