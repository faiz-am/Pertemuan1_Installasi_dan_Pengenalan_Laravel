<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CartItem extends Model
{
    protected $fillable = [
        'cart_id', 'itemable_id', 'itemable_type', 'quantity',
    ];

    public function itemable(): MorphTo
    {
        return $this->morphTo();
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
