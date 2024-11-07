<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    protected $primaryKey = 'id_post';

    protected $fillable = [
        'name',
        'describe',
        'id_category_post',
        'content',
        'image',
    ];

    // cấu hình quan hệ giữaa category_post và post

    public function category_post()
    {
        return $this->belongsTo(CategoryPost::class,'id_category_post');
    }

    // thực thi cấu hình quan hệ giữa post và product (n-n)
    public function product()
    {
        return $this->belongsToMany(Product::class,'post_product','id_post','id_product');
    }
}
