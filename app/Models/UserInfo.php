<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'birthdate',
        'interests',
        'gender',
        'registred_users_id',
        'image'
    ];

    public function registeredUser()
    {
        return $this->belongsTo(RegistredUsers::class);
    }
}
