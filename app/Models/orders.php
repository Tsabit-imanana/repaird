<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    protected $primaryKey = 'orders_id';

    protected $fillable = [
        'order_id',
        'cust_id',
        'device_id',
        'condition',
        'date',
        'user_id',
        'price',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id');
    }

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }
}
