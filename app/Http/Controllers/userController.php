<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\RegistredUsers;
use App\Models\UserInfo;
use App\Repositories\UserRepository;
use App\Services\UserProfileService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $userInfo;
    public $registredUsers;
    public $userProfileService;
    public $userRepository;
    /**
     * userController consturcor
     * @param UserRepository $userRepository
     * @param UserInfo $userInfo
     * @param RegistredUsers $registredUsers
     */
    public function __construct(UserInfo $userInfo, UserRepository $userRepository, UserProfileService $userProfileService)
    {
        $this->userRepository = $userRepository;
        $this->userInfo = $userInfo;
        $this->userProfileService = $userProfileService;
    }
    /**
     * @return mixed
     */
    public function showUserProfile()
    {

        $userInfo = Auth::user()->userInfos;

        return view("user.CurrentUserProfile")->with(['data' => $userInfo]);
    }
    /**
     * @param ProfileRequest $request
     * @return void
     */
    public function setUserData(ProfileRequest $request)
    {
        $requestData = $request->validated();

        $this->userRepository->updateUserName($requestData['nickname']);
        $validatedPath = $this->userProfileService->saveUserPhoto($request->file('image'));

        $requestData['image'] = $validatedPath;

        $this->userRepository->updateUserInfo($requestData);
    }

    public function deleteImage(){
        $this->userRepository->deleleUserImage();
    }
}
