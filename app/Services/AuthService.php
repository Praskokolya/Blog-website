<?php

namespace App\Services;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Auth;

class AuthService{
    protected $AuthRepository;

    public function __construct(AuthRepository $authRepository) {
        $this->authRepository = $authRepository;
    }
    public function checkIfLogged($loginResult, $passwordForCheck, $usersEmail){
        if (Auth::attempt(['email' => $usersEmail, 'password' => $passwordForCheck])) {
            return true;
        } else {
            return null;
        }
    }
}
