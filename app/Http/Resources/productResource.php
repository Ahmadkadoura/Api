<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class productResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $response = [
            'id' => $this->id,
            'scientific_name' => $this->scientific_name,
            'trading_name' => $this->trading_name,
            'manufacturer' => $this->manufacturer,
            'Date_of_validity' => $this->date_of_validity,
            'quantity' => $this->quantity,
            'price' => number_format($this->price) . ' sp',
            'image' => public_path($this->image),
            'category' => new CategoryResource($this->category),
        ];

        if ($this->favorite !== null) {
            $response['is_favorite'] = $this->favorite->is_favorite;
        }
        else
        {
            $response['is_favorite'] =0;
        }

        return $response;
    }
}
