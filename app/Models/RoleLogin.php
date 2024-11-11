<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleLogin extends Model
{
    use HasFactory;
    protected $table = 'roles_login';
    protected $primaryKey = 'id_roles_login';

    protected $fillable = [
        'name',
        'describe',
    ];

    // thực thi cấu hình quan hệ giữa accountadmin với rolelogin quan hệ n n
    public function roleLogin()
    {
        return $this->belongsToMany(RoleLogin::class,'id_admin_role','id_roles_login','id_account_admin');
    }
}
