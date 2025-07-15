<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id',
        'order_date',
        'total_amount',
        'status',
        'tracking_number',
    ];

    // Relasi ke detail pesanan
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    // Alias untuk orderDetails (tidak wajib, opsional)
    public function items()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    // Relasi ke customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
