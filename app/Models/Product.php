<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo(Categories::class,'product_category_id');
    }
}