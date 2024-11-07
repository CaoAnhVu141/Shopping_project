<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'review';
    protected $primaryKey = 'id_review';

    protected $fillable = [
        'id_product',
        'id_customer',
        'comment',
        'rating',
    ];

    // thực thi cấu hình quan hệ giữa product và review (1-n)
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    // thực thi quan hệ giữa customer và review (1-n)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer');
    }
}
