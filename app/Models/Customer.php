<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Thêm dòng này
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable // Thay đổi từ Model thành Authenticatable
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'id_customer';

    protected $fillable = [
        'name',
        'email',
        'status',
        'password',
        'token',
        'phone',
        'address',
    ];

    // thực thi cấu hình quan hệ customer và shopping_cart (1-n)
    public function shoppingCart()
    {
        return $this->hasMany(ShoppingCart::class, 'id_customer');
    }

    // thực thi quan hệ giữa customer và review (1-n)
    public function review()
    {
        return $this->hasMany(Review::class, 'id_customer');
    }

    // cấu hình quan hệ giữa customer và contact (1-n)
    public function contact()
    {
        return $this->hasMany(Contact::class, 'id_customer');
    }

    // thực thi cấu hình giữa customer và product (n-n)
    public function product()
    {
        return $this->belongsToMany(Product::class, 'favorite', 'id_customer', 'id_product');
    }

    // thiết lập quan hệ giữa customer và order (1-n)
    public function order()
    {
        return $this->hasMany(Order::class, 'id_customer');
    }
}