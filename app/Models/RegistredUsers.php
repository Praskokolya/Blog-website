<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class RegistredUsers extends Authenticatable
{
    use HasFactory;

    public $table = 'registred_users';
    protected $fillable = ['nickname', 'email', 'password'];

}

