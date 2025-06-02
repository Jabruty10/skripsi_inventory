<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Login extends Authenticatable
{
    protected $table = 'login';
    protected $primaryKey = 'id_user';
    public $timestamps = false;

    protected $fillable = ['username', 'password'];
    protected $hidden = ['password'];

    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
