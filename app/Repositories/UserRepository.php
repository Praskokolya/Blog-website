<?php

namespace App\Repositories;

use App\Models\RegistredUsers;
use App\Models\UserInfo;
use Illuminate\Support\Facades\Auth;


class UserRepository
{

    private $userInfo;
    private $registredUsers;
    public $user;
    public function __construct(UserInfo $userInfo, RegistredUsers $registredUsers)
    {
        $this->registredUsers = $registredUsers;
        $this->userInfo = $userInfo;
        $this->user = Auth::user();
    }
    /**
     * @param integer $id
     * @return void
     */
    public function create()
    {
        $this->userInfo->create([
            'registred_users_id' => Auth::id(),
        ]);
    }
    /**
     * Undocumented function
     *
     * @param array $requestData
     * @return void
     */
    public function updateUserInfo(array $requestData)
    {
        unset($requestData['nickname']);
        Auth::user()->userInfos->first()->update($requestData);
    }
    public function updateUserName($nickname)
    {
        $this->registredUsers->find(Auth::id())->update(['nickname' => $nickname]);
    }
    public function getUserImage()
    {
        return Auth::user()->userInfos->first()->image;
    }
    public function deleleUserImage()
    {
        Auth::user()->userInfos->first()->update(
            [
                'image' => null
            ]
        );
    }
}
