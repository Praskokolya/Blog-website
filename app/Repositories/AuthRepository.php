<?php

namespace App\Repositories;

use App\Models\RegistredUsers;
use App\Services\UserProfileService;
use Illuminate\Support\Facades\Auth;

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
    public $userProfileService;
    public $userRepository;
    public function __construct(UserProfileService $userProfileService, RegistredUsers $users, UserRepository $userRepository)
    {
        $this->userProfileService = $userProfileService;
        $this->userRepository = $userRepository;
        $this->users = $users;
    }

    /**
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
        if ($emailForCheck = $this->users
            ->where('email', $usersEmail)->first()
        ) {
            return $emailForCheck->password;
        };
    }
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
