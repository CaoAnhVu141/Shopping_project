<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory;

    // Thiết lập tên bảng và khóa chính
    protected $table = 'customers';
    protected $primaryKey = 'id_customer';

    // Các thuộc tính có thể gán giá trị hàng loạt
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'verification_token',
        'is_verified',
        'address',
        'status',
        'token'
    ];

    // 1. Quan hệ 1-N với bảng ShoppingCart
    public function shoppingCart()
    {
        return $this->hasMany(ShoppingCart::class, 'id_customer');
    }

    // 2. Quan hệ 1-N với bảng Review
    public function review()
    {
        return $this->hasMany(Review::class, 'id_customer');
    }

    // 3. Quan hệ 1-N với bảng Contact
    public function contact()
    {
        return $this->hasMany(Contact::class, 'id_customer');
    }

    // 4. Quan hệ nhiều-nhiều với bảng Product qua bảng trung gian Favorite
    public function product()
    {
        return $this->belongsToMany(Product::class, 'favorite', 'id_customer', 'id_product');
    }

    // 5. Quan hệ 1-N với bảng Order
    public function order()
    {
        return $this->hasMany(Order::class, 'id_customer');
    }
}
