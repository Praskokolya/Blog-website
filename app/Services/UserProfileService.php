<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileService
{
    /**
     * @param $image
     * @return mixed
     */

    public $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    /**
     *
     * @param $image
     * @return mixed
     */
    public function saveUserPhoto($image)
    {
        if ($image) {
            $extension = $image->getClientOriginalExtension();
            $userPhoto = Auth::user()->nickname . '.' . $extension;
            $path = $image->storeAs('images', $userPhoto, 'public');
            return $path;
        } else {
            return $this->userRepository->getUserImage();
        }
    }
    public function saveUserPhotoFromTwitterOrGoogle($image)
    {
        if ($image) {
            $imageContent = file_get_contents($image);
            $extension = pathinfo($image, PATHINFO_EXTENSION);
            if($extension == ""){
                $userPhoto = Auth::user()->nickname;
            }else{
                $userPhoto = Auth::user()->nickname . '.' . $extension;
            }
 
            Storage::put("public/images/{$userPhoto}", $imageContent);
            return '/images/' . $userPhoto;
            
        } else {
            return $this->userRepository->getUserImage();
        }
    }
}
