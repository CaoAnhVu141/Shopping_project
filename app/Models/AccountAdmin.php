<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountAdmin extends Model
{
    use HasFactory;
    protected $table = 'account_admin';
    protected $primaryKey = 'id_account_admin';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // thực thi cấu hình quan hệ giữa accountadmin với rolelogin quan hệ n n
    public function roleLogin()
    {
        return $this->belongsToMany(RoleLogin::class,'id_admin_role','id_account_admin','id_roles_login');
    }
}
