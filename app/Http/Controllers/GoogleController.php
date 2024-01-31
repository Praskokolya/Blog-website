<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepository;
use App\Repositories\GoogleAuthRepository;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{

    public $googleAuthRepository;
    public function __construct(GoogleAuthRepository $googleAuthRepository)
    {
        $this->googleAuthRepository = $googleAuthRepository;
    }
    public function logWithGoogle()
    {
        return Socialite::driver("google")->redirect();
    }
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->googleAuthRepository->checkIfLoggedByGoogle($user);
        return redirect('/user/profile');
    }
}
