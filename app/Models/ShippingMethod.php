<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory;

    protected $table = 'shipping_method';
    protected $primaryKey = 'id_shipping_method';

    protected $fillable = [
        'method_name',
        'cost',
        'estimated_time',
    ];


    // thiết lập quan hệ giữa shipping_method và order (1-n)
    public function order()
    {
        return $this->hasMany(Order::class,'id_shipping_method');
    }
}
