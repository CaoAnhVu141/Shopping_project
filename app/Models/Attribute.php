<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'attribute';
    protected $primaryKey = 'id_attribute';

    protected $fillable = [
        'name',
        'describe',
    ];

    // thực thi cấu hình quan hệ giữa attribute và attibutevalue (1-n)

    public function attibuteValue()
    {
        return $this->hasMany(AttributeValue::class,'id_attribute');
    }



    // thực thi thiết lập quan hệ giữa 3 bảng ==> bảng phụ:  Product_attributes
   // Quan hệ với product
   public function product()
   {
       return $this->belongsToMany(Product::class, 'product_attribute', 'id_attribute', 'id_product');
   }
    //
}
