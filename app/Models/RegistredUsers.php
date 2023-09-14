<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistredUsers extends Authenticatable
{
    use HasFactory;

    protected $table = 'registred_users';
    protected $fillable = ['nickname', 'email', 'password'];

}

