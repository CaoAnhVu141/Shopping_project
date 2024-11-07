<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = 'id_category';

    protected $fillable = [
        'name',
        'describe',
    ];

    // thực thi cấu hình quan hệ giữa product và category

    public function product()
    {
        return $this->hasMany(Product::class,'id_product');
    }
}
