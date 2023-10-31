<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class UserProfileService{
    /**
     * @param $image
     * @return mixed
     */

    public $userRepository;
    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    /**
     *
     * @param $image
     * @return mixed
     */
    public function saveUserPhoto($image){
        if ($image) {
            $extension = $image->getClientOriginalExtension();
            $userPhoto = Auth::user()->nickname . '.' . $extension;
            $path = $image->storeAs('images', $userPhoto, 'public');
            return $path;
        }else{
            return $this->userRepository->getUserImage();
        }
    }
}