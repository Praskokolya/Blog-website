<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Repositories\AuthRepository;
class AuthController extends Controller
{
    /** @var AuthService */
    public $authService;

    /** @var AuthRepository */
    public $authRepository;

    /**
     * AuthController constructor
     * @param AuthService $authService
     * @param AuthRepository $authRepository
     */
    public function __construct(AuthService $authService, AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
        $this->authService = $authService;
    }
    /**
     *    
     * @param AuthLoginRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createAccount(AuthLoginRequest $request)
    {
        $nickname = $request->input('nickname');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $user = $this
            ->authRepository
            ->createNewUser($password, $nickname, $email);

        Auth::login($user);

        return view('home', ['user' => $user->nickname]);
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
