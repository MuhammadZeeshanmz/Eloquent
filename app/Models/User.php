<?php

namespace App\Models;

use App\Traits\PermissionTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Routing\Route;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use PermissionTrait;

    use HasApiTokens, Notifiable;
    protected $table = 'user';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_permission_id'

    ];

    public function rolePermission(){

        return $this->belongsTo(RolePermission::class, 'role_permission_id');
    }

    public function role(){

        return $this->belongsTo(Role::class, 'role_permission_id', 'id');
    }
}
