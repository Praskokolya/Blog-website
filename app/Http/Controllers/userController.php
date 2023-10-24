<?php

namespace App\Http\Controllers;

use App\Models\RegistredUsers;
use App\Models\UserInfo;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public $userInfo;
    public $registredUsers;

    public $userRepository;
    /**
     * userController consturcor
     *
     * @param UserInfo $userInfo
     * @param RegistredUsers $registredUsers
     */
    public function __construct(UserInfo $userInfo, RegistredUsers $registredUsers, UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->userInfo = $userInfo;
        $this->registredUsers = $registredUsers;
    }
    public function showUserProfile()
    {

        $userInfo = Auth::user()->userInfo;

        if ($userInfo->isEmpty()) {
            $this->userRepository->create(Auth::id());
            return redirect('/user/profile');
        }

        return view("user.CurrentUserProfile")->with(['data' => $userInfo]);
    }
    /**
     * @param Request $request
     */

    public function setUserData(Request $request)
    {
        // dd($request);

        $this->registredUsers->where('id', Auth::id())->update(['nickname' => $request->input('name')]);

        $user = $this->userInfo::where('registred_users_id', Auth::id())->first();

        $image = $request->file('image');
        
        $extension = $image->getClientOriginalExtension();
        $newName = Auth::user()->nickname . '.' . $extension;
        $path = $image->storeAs('images', $newName, 'public');
        
        if ($user) {
            $birthdate = $request->input('birthdate');
            $interests = $request->input('interests');
            $gender = $request->input('gender');

            $this->userRepository->update($user, $birthdate, $gender, $interests, Auth::id(), $path);
        }
    }
}
