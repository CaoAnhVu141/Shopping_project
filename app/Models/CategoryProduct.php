<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
     protected $table = 'category'; // Tên bảng thực tế trong cơ sở dữ liệu

    protected $fillable = [
        'mn_name', 'mn_description',
    ];
}
