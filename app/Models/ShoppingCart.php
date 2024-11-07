<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table = 'shopping_cart';
    protected $primaryKey = 'id_shopping_cart';

    protected $fillable = [
        'id_customer',
        'id_product',
        'id_session',
        'quantity',
        'price',
        'total_price',
    ];

    // thực thi cấu hình quan hệ giữa product và shopping_cart (1-n)

    public function product()
    {
        return $this->belongsTo(Product::class,'id_product');
    }

    // thực thi cấu hình quan hệ customer và shopping_cart (1-n)
    public function customer()
    {
    // thực thi cấu hình quan hệ customer và shopping_cart (1-n)
        return $this->belongsTo(Customer::class,'id_customer');
    }
}
