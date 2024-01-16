<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RegisterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this['user']['name'],
            'pharmacy_name' => $this['user']['pharmacy_name'],
            'phone' => $this['user']['phone'],
            'address' => $this['user']['address'],
            'access_token' => $this['access_token'],
        ];
    }
}
