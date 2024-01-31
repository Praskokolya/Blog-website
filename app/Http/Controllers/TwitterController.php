<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepository;
use App\Services\TwitterService;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public $authRepository;


    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function logWithTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        $user = Socialite::driver('twitter')->user();
        $this->authRepository->checkIfLoggedByTwitter($user);
        return redirect('/user/profile');
    }
}
