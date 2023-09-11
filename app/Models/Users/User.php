<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // 更新可能なカラム
    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_role',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
