<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contact';
    protected $primaryKey = 'id_contact';

    protected $fillable = [
        'id_customer',
        'name',
        'email',
        'phone',
        'message',
    ];

    // cấu hình quan hệ giữa customer và contact (1-n)
    public function customer()
    {
        return $this->belongsTo(Customer::class,'id_customer');
    }
}
