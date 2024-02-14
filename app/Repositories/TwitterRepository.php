<?php

namespace App\Repositories;

use App\Models\RegistredUsers;
use App\Services\UserProfileService;
use Illuminate\Support\Facades\Auth;

class TwitterRepository
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
    public $userProfileService;
    public $userRepository;
    public function __construct(UserProfileService $userProfileService, RegistredUsers $users, UserRepository $userRepository)
    {
        $this->userProfileService = $userProfileService;
        $this->userRepository = $userRepository;
        $this->users = $users;
    }

    /**
     * createUserWithTwitter
     *
     * @param [type] $user
     * @return void
     */
    public function createUserWithTwitter($user)
    {
        return $this->users->create([
            'nickname' => $user->nickname,
            'email' => null,
            'password' => null,
            'twitter_id' => $user->id,
        ]);
    }
    public function checkIfLoggedByTwitter($user)
    {
        $existingUser = $this->users->where('twitter_id', $user->id)->first();

        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            Auth::login($this->createUserWithTwitter($user));
            $this->userRepository->create();
            $this->userRepository->updateUserInfo(['image' => $this->userProfileService->saveUserPhotoFromTwitterOrGoogle($user->avatar)]);
        }
    }
}
