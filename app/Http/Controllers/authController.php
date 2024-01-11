<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Repositories\AuthRepository;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
    /** @var AuthService */
    public $authService;
    /**
     * @var UserRepository
     */
    public $userRepository;

    /** @var AuthRepository */
    public $authRepository;

    /**
     * AuthController constructor
     * @param AuthService $authService
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthService $authService, AuthRepository $authRepository, UserRepository $userRepository)
    {
        $this->authRepository = $authRepository;
        $this->authService = $authService;
        $this->userRepository = $userRepository;
    }
    /**
     *    
     * @param AuthLoginRequest $request
     * @return mixed
     */
    public function createAccount(AuthLoginRequest $request)
    {
        $nickname = $request->input('nickname');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $user = $this->authRepository
            ->createNewUser($password, $nickname, $email);
            
        Auth::login($user);
         
        $this->userRepository->create();
        return redirect('/user/profile');

    }
    /** 
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function checkIfLog(LoginRequest $request)
    {
        $this->authRepository->getLoggedUser($request->email);
        $user = $this->authService->checkIfLogged($request->password, $request->email);

        if ($user) {
            return redirect()->route('home');
        } else {
            return redirect('/auth/log')->with('error', 'Wrong email or password');
        }
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/');
    }
}
