<?php

namespace App\Models;

use App\Models\Contact;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistredUsers extends Authenticatable
{
    use HasFactory;

    public $table = 'registred_users';
    protected $fillable = ['nickname', 'email', 'password'];
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function userInfo(){
        return $this->hasMany(UserInfo::class);
    }
}
