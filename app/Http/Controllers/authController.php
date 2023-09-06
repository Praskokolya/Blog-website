<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthLoginRequest;
use App\Models\RegistredUsers;
use Illuminate\Http\Request;
class authController extends Controller
{
    public function signUpForm(){
        return view('RegComponents.signUp');
    }

    public function registration(){
        return view('RegComponents.register');
    }
    public function login(){
        return view('RegComponents.login');
    }
    public function createAccount(AuthLoginRequest $req){
        $registredUser = new RegistredUsers(); 
        $registredUser->nickname = $req->input('nickname');
        $registredUser->email = $req->input('email');
        $registredUser->password = bcrypt($req->input('password')); 
        $registredUser->save();

        Auth::login($registredUser);
        return redirect('/');
    }

    
}
