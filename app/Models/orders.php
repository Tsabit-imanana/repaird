<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'cust_id',
        'device_id',
        'status',
        'date',
        'user_id',
        'price'
    ];
}
