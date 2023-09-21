<?php

namespace App\Repositories;

use App\Models\RegistredUsers;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    public $users;

    public function __construct(RegistredUsers $users)
    {
        $this->users = $users;
    }

    public function createNewUser($password, $nickname, $email)
    {
        $user = $this->users->create([
            'nickname' => $nickname,
            'email' => $email,
            'password' => $password,
        ]);
        return $user;
    }

    public function getLoggedUser($usersEmail)
    {
        if ($emailForCheck = $this->users->where('email', $usersEmail)->first()) {
            $passwordOfUser = $emailForCheck->password;

            $result = $passwordOfUser;

            return $result;
        }
        ;
    }
}