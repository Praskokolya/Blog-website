<?php

namespace App\Services;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;

class AuthService{
    /**
     *
     * @var $authRepository
     */
    protected $authRepository;

    /**
     * AuthService costructor
     * @param AuthRepository $authRepository
     */

    public function __construct(AuthRepository $authRepository) {
        $this->authRepository = $authRepository;
    }
    /**
     *
     * @param string $passwordForCheck
     * @param string $usersEmail
     * @return mixed
     */
    public function checkIfLogged(string $passwordForCheck, string $usersEmail){
        if (Auth::attempt(['email' => $usersEmail, 'password' => $passwordForCheck])) {
            return true;
        } else {
            return null;
        }
    }
}
