<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $table = 'attribute_value';
    protected $primaryKey = 'id_attribute_value';

    protected $fillable = [
        'id_attribute',
        'value',
    ];

    // thực thi cấu hình quan hệ giữa attribute và attibutevalue (1-n)
    public function attribute()
    {
        return $this->belongsTo(Attribute::class,'id_attribute');
    }



    // thực thi thiết lập quan hệ giữa 3 bảng ==> bảng phụ:  Product_attributes
    // Quan hệ với Product
    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_attribute', 'id_attribute_value', 'id_product');
    }

}
