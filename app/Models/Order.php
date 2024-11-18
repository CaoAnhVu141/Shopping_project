<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $primaryKey = 'id_order';
    protected $fillable = [
        'id_customer',
        'id_session',
        'customer_name',
        'customer_phone',
        'customer_email',
        'customer_address',
        'id_shipping_method',
        'id_payment',
        'total_item',
        'status',
        'shipping_address',
        'order_date',
    ];

    // thiết lập quan hệ giữa order và oder_status_history (1-n)
    public function orderStatusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class, 'id_order');
    }

    // thiết lập quan hệ giữa order và payment (1-n)
    public function payment()
    {
        return $this->belongsTo(Payment::class, 'id_payment');
    }

    // thiết lập quan hệ giữa customer và order (1-n)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    // thiết lập quan hệ giữa shipping_method và order (1-n)
    public function shippingMethod()
    {
        return $this->belongsTo(ShippingMethod::class, 'id_shipping_method');
    }

    //
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'id_order');
    }


    // thiết lập truy vấn lấy dữ liệu tìm kiếm dashboard
    public function scopeFindByCustomerDashboard($query, $email = null, $status = null)
    {
        if ($email) {
            $query->whereHas('customer', function ($q) use ($email) {
                $q->where('email', 'LIKE', "%$email%");
            });
        }

        if ($status) {
            $query->where('status', $status);
        }
        return $query;
    }

    //@viết tính tổng số đơn hàng thành công
    public static function modelCountSuccesItems()
    {
        return self::where('status', 'Đã Bàn Giao')->count();
    }

    //@viết phương thức lấy toàn bộ doanh thu từ order
    public static function getAllTotal_itemOrder()
    {
        return self::where('status', 'Đã Bàn Giao')->sum('total_item');
    }

    // // mã hoá id
    // protected $appends = ['encrypted_id'];
    // // Accessor cho encrypted_id
    // public function getEncryptedIdAttribute()
    // {
    //     return Crypt::encrypt($this->attributes['id_order']);
    // }
}
