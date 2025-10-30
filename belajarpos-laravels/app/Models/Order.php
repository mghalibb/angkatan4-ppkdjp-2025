<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'order_date',
        'total_amount',
        'payment_method',
        'payment_amount',
        'payment_change',
        'discount_code',
        'discount_amount',
        'order_status'
    ];
}
