<?php

namespace App\Http\Resources;

use App\Enums\OrderStatusType;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
        'total' => $this->total,
        'created_at' => $this->created_at,
        'user_id'=>$this->user_id,
        'order_status'=>__($this->order_status->name),
        'quantity_items' => $this->orderItems->map(function ($orderItem) {
            return $orderItem->quantity_item;
        }),
        'product' => $this->orderItems->map(function ($orderItem) {
            return new OrderItemProductResource($orderItem);
        }),
    ];
    }
}
