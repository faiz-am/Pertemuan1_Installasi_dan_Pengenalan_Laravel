<?php

// app/Models/Order.php

namespace App\Models;
use App\Models\OrderDetail;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'order_date', 'total_amount', 'status', 'tracking_number'
    ];


    // app/Models/Order.php

    public function items()
    {
        return $this->hasMany(OrderDetail::class);
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderDetails()
{
    return $this->hasMany(OrderDetail::class);
}


    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
