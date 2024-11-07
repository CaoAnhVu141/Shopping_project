<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $table = 'discount';
    protected $primaryKey = 'id_discount';

    protected $fillable = [
        'code',
        'describe',
        'start_day',
        'end_day',
    ];

    // thực thi cấu hình quan hệ giữa discount và product (n-n)
    public function product()
    {
        return $this->belongsToMany(Product::class,'product_discount','id_discount','id_product');
    }
}
