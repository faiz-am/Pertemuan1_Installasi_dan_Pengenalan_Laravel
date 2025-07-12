<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    
    protected $table = 'product_categories';
    protected $fillable = [
    'name',
    'slug',
    'description',
    'image',
    'status', // ⬅️ tambahkan ini
];
public function scopeActive($query)
{
    return $query->where('status', true);
}

}