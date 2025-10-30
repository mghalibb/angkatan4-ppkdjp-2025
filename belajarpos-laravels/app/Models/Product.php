<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'id',
        'category_id',
        'product_name',
        'photo',
        'price',
        'product_description',
        'is_active',
        'delete_at'
    ];
}
