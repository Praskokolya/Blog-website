<?php

namespace App\Models;

use App\Models\Contact;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegistredUsers extends Authenticatable
{
    use HasFactory;

    public $table = 'registred_users';
    protected $fillable = ['nickname', 'email', 'password', 'twitter_id', 'google_id', 'email_code'];
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function userInfos(){
        return $this->hasMany(UserInfo::class);
    }
}
