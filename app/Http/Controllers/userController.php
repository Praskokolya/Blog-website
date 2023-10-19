<?php

namespace App\Http\Controllers;

use App\Models\RegistredUsers;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    public $userInfo;
    public $registredUsers;

    /**
     * userController consturcor
     *
     * @param UserInfo $userInfo
     * @param RegistredUsers $registredUsers
     */
    public function __construct(UserInfo $userInfo, RegistredUsers $registredUsers)
    {
        $this->userInfo = $userInfo;
        $this->registredUsers = $registredUsers;
    }
    public function showUserProfile(){
        return view('user.CurrentUserProfile')->with(['data' => $this->userInfo->where('user_id', Auth::id())->get()]);
    }
    /**
     * @param Request $request
     */
    
    public function setUserData(Request $request)
    {
        
        $this->registredUsers->where('id', $request->input('data.user_id'))
            ->update(
                [
                    'nickname' => $request->input('data.name')
                ]
            );
        $user = $this->userInfo::where('user_id', $request->input('data.user_id'))
            ->first();

        if ($user) {
            $user->update([
                'birthdate' => $request->input('data.birthdate'),
                'interests' => $request->input('data.interests'),
                'user_id' => $request->input('data.user_id'),
                'gender' => $request->input('data.gender')
            ]);
        } else {
            $this->userInfo
                ->create([
                    'birthdate' => $request->input('data.birthdate'),
                    'interests' => $request->input('data.interests'),
                    'user_id' => $request->input('data.user_id'),
                    'gender' => $request->input('data.gender')
                ]);
        }
        
    }
}
