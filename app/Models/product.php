<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fillable = [
        'scientific_name',
        'trading_name',
        'date_of_validity',
        'manufacturer',
        'price',
        'quantity',
        'Category_id',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function favorite()
    {
        return $this->hasOne(Favorites::class );
    }
    public function orderItem()
    {
        return $this->hasMany (OrderItem::class );
    }
}
