<?php

namespace App\Http\Controllers;
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
        $registredUser = new RegistredUsers(); // Используйте правильное имя класса модели
        $registredUser->nickname = $req->input('nickname');
        $registredUser->email = $req->input('email');
        $registredUser->password = bcrypt($req->input('password')); // Обычно пароль хешируется перед сохранением
        $registredUser->save();
        Auth::login($registredUser);
    }

    
}
