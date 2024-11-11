<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'id_payment';

    protected $fillable = [
        'payment_method',
        'describe',
    ];

    // thiết lập quan hệ giữa order và payment (1-n)
    public function orders()
    {
        return $this->hasMany(Order::class, 'id_payment');
    }
    
}
