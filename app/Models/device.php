<?php

namespace App\Models;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class device extends Model
{
    use HasFactory;
    protected $primaryKey = 'device_id';

    protected $fillable = [
        'cust_id',
        'product',
        'type',
        'damage'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'cust_id');
    }

    public function order()
    {
        return $this->hasMany(Orders::class, 'device_id');
    }
}
