<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'id_product';

    protected $fillable = [
        'id_category',
        'name',
        'describe',
        'price',
        'images',
        'hot',
        'is_active',
        'sale',
        'number_of_purchases',
        'quantity_available',
    ];

    //thực thi cấu hình quan hệ giữa bảng product và category (1-n)

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }

    // thực thi cấu hình quan hệ giữa product và shopping_cart (1-n)

    public function shoppingCart()
    {
        $this->hasMany(ShoppingCart::class, 'id_product');
    }

    // thực thi cấu hình quan hệ giữa product và review (1-n)

    public function review()
    {
        return $this->hasMany(Review::class, 'id_product');
    }

    // thực thi cấu hình quan hệ giữa discount và product (n-n)
    public function discount()
    {
        return $this->belongsToMany(Discount::class, 'product_discount', 'id_product', 'id_discount');
    }

    // thực thi cấu hình quan hệ giữa post và product (n-n)
    public function post()
    {
        return $this->belongsToMany(Post::class, 'post_product', 'id_product', 'id_post');
    }

    // thực thi cấu hình giữa customer và product (n-n)
    public function customer()
    {
        return $this->belongsToMany(Customer::class, 'favorite', 'id_product', 'id_customer');
    }

    // thực thi thiết lập quan hệ giữa 3 bảng ==> bảng phụ:  Product_attributes
    //quan hệ với attribute
    public function attribute()
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute', 'id_product', 'id_attribute');
    }

    //quan hệ với attribute_value
    public function attributeValue()
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute', 'id_product', 'id_attribute_value');
    }

    //
    // viết đếm số lượng sản phẩm trong table product
    public static function countDataProducts()
    {
        return self::count();
    }

    // thực thi mã hoá lại trường slug để hiện thị trên url
    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            $product->slug = Str::slug($product->name); // Tạo slug từ tên sản phẩm
        });
    }
}
