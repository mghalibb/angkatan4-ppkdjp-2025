<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calculator extends Model
{
    protected $fillable = [
        'value1',
        'simbol',
        'value2',
        'results'
    ];
}
