<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistredUsers extends Model
{
    use HasFactory;
    protected $table = 'registred_users';
    protected $fillable = ['nickname', 'email', 'password'];
    
}
