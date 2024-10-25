<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $table = 'favorite'; // Tên bảng trong cơ sở dữ liệu
    protected $primaryKey = 'id_favorite'; // Khóa chính

    protected $fillable = [
        'id_customer',
        'id_product',
    ];

    // Thiết lập quan hệ với model Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }

    // Thiết lập quan hệ với model Product 
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
