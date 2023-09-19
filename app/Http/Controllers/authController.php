<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Repositories\AuthRepository;

class authController extends Controller
{
    public $authService;
    public $authRepository;
    public function __construct(AuthService $authService, AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
        $this->authService = $authService;
    }
    public function signUpForm()
    {
        return view('RegComponents.signUp');
    }
    public function registration()
    {
        return view('RegComponents.register');
    }
    public function login()
    {
        return view('RegComponents.login');
    }
    public function createAccount(AuthLoginRequest $request)
    {
        $nickname = $request->input('nickname');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $user = $this->authRepository->createNewUser($password, $nickname, $email);

        Auth::login($user);

        return view('home', ['user' => $user->nickname]);
    }
    public function checkIfLog(LoginRequest $request)
    {
        $userEmail = $request->email;
        $loginResult = $this->authRepository->getLoggedUser($userEmail);
        $passwordForCheck = $request->password;
        $user = $this->authService->checkIfLogged($loginResult, $passwordForCheck, $userEmail);

        if ($user) {
            return redirect()->route('home');
        } else {
            return redirect()->route('login')->with('error', 'Wrong email or password');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/');
    }
}
