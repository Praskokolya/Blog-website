<?php

namespace App\Http\Controllers;

use App\Repositories\AuthRepository;
use App\Repositories\TwitterRepository;
use App\Services\TwitterService;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public $twitterRepository;


    public function __construct(TwitterRepository $twitterRepository)
    {
        $this->twitterRepository = $twitterRepository;
    }
    public function logWithTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function handleTwitterCallback()
    {
        $user = Socialite::driver('twitter')->user();
        $this->twitterRepository->checkIfLoggedByTwitter($user);
        return redirect('/user/profile');
    }
}
