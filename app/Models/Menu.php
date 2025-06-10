<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'menu_text',
        'menu_icon',
        'menu_url',
        'menu_order',
        'status',
    ];
}