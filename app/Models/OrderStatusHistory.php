<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

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
        return $this->belongsTo(Order::class, 'id_order');
    }

    //Viết phương thức full text search cho lịch sử mua hàng
    public function scopeSearch($query, $keyword)
    {
        return $query->whereHas('order', function ($q) use ($keyword) {
            $q->whereRaw("MATCH(customer_name, customer_email, shipping_address, status) AGAINST(? IN BOOLEAN MODE)", [$keyword]);
        });
    }

    // //thực thi mã hoá id cho xem chi tiết lịch sử mua hàng
    // public function getEncryptedIdAttribute()
    // {
    //     return Crypt::encryptString($this->id);
    // }
}
