<?php

namespace App\Models;

use App\Enums\OrderStatusType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'total', 'user_id','order_status', 'order_item_id'];

    protected $casts=[
        'order_status'=>OrderStatusType::class
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    public function products()
{
    return $this->hasManyThrough(Product::class, OrderItem::class);
}
}
