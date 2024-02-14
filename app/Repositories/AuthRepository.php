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
    public function createNewUser($request)
    {
        $request['password'] = bcrypt($request['password']);
        return $this->users->create($request);
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
 
}
