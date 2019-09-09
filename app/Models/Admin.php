<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = "admins";

    protected $fillable = [
        'username', 'phone', 'email', 'photo', 'nickname', 'sex', 'password', 'desc', 'status', 'ipaddr',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
