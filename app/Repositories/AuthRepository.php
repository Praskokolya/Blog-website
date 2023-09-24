<?php

namespace App\Repositories;

use App\Models\RegistredUsers;

class AuthRepository
{
    /**
     * @var $users
     */

    public $users;

    /**
     * AuthRepository constructor
     *
     * @param RegistredUsers $users
     */
    public function __construct(RegistredUsers $users)
    {
        $this->users = $users;
    }

    /**
     *
     * @param string $password
     * @param string $nickname
     * @param string $email
     * @return mixed
     */
    public function createNewUser(string $password, string $nickname, string $email)
    {
        return $this->users->create([
            'nickname' => $nickname,
            'email' => $email,
            'password' => $password,
        ]);
    }
    /**
     *
     * @param string $usersEmail
     * @return mixed
     */
    public function getLoggedUser(string $usersEmail)
    {
        if ($emailForCheck = $this
            ->users
            ->where('email', $usersEmail)->first()
        ) {
            return $emailForCheck->password;       
        };
    }
}
