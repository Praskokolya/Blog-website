<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepository;
use App\Repositories\GoogleAuthRepository;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class GoogleController
 * 
 * @package App\Http\Controllers
 */
class GoogleController extends Controller
{
    /**
     * @var GoogleAuthRepository
     */
    public $googleAuthRepository;

    /**
     * GoogleController constructor.
     *
     * @param GoogleAuthRepository $googleAuthRepository
     */
    public function __construct(GoogleAuthRepository $googleAuthRepository)
    {
        $this->googleAuthRepository = $googleAuthRepository;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function logWithGoogle()
    {
        return Socialite::driver("google")->redirect();
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        $this->googleAuthRepository->checkIfLoggedByGoogle($user);
        return redirect('/user/profile');
    }
}
