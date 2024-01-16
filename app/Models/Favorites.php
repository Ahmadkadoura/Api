<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{

    use HasFactory;
    protected $casts = [
        'status' => 'boolean',
    ];
    protected $fillable = [
        'is_favorite',
        'product_id',
        'user_id'
    ];
    public function product()
    {
        return $this->belongsTo(product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
