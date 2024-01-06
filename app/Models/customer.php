<?php

namespace App\Models;
use App\Models\Orders;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;

    protected $primaryKey = 'cust_id';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    public function devices()
    {
        return $this->hasMany(Device::class, 'cust_id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'cust_id');
    }

    
}
