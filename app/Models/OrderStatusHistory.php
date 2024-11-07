<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'order_status_history';
    protected $primaryKey = 'id_order_histories';

    protected $fillable = [
        'id_order',
        'status',
    ];

    // thiết lập quan hệ giữa oder và oder_status_history (1-n)
    public function order()
    {
        return $this->belongsTo(Order::class,'id_order');
    }
}
