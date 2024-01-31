<?php

namespace App\Repositories;

use App\Models\RegistredUsers;
use App\Services\UserProfileService;
use Illuminate\Support\Facades\Auth;

class GoogleAuthRepository{
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

    public function createUserWithGoogle($user){
        return $this->users->create([
            'nickname' => $user->name,
            'email' => null,
            'password' => null,
            'google_id' => $user->id,
        ]);
    }
    public function checkIfLoggedByGoogle($user)
    {
        $existingUser = $this->users->where('twitter_id', $user->id)->first();

        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            Auth::login($this->createUserWithGoogle($user));
            $this->userRepository->create();
            $this->userRepository->updateUserInfo(['image' => $this->userProfileService->saveUserPhotoFromTwitterOrGoogle($user->avatar)]);
        }
    }
}