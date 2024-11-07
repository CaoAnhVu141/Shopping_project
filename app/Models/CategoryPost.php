<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'category_posts';
    protected $primaryKey = 'id_category_post';

    protected $fillable = [
        'name',
        'describe',
    ];

    // thực thi cấu hình quan hệ category_post và post

    public function post()
    {
        return $this->hasMany(Post::class,'id_post');
    }
}
