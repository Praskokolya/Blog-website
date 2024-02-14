<?php

namespace App\Http\Controllers;

use App\Events\UserCreating;
use App\Mail\Register;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthLoginRequest;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Repositories\AuthRepository;
use App\Repositories\UserRepository;
use App\Services\EmailService;
use App\Services\UserProfileService;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /** @var AuthService */
    public $authService;
    /**
     * @var UserRepository
     */
    public $userRepository;

    /**
     *  @var AuthRepository 
     */
    public $authRepository;
    /**
     * @var userProfileService
     */
    public $userProfileService;
    /** @var emailService 
     * 
     */
    public $emailService;
    /**
     * authController consctuctor
     *
     * @param UserProfileService $userProfileService
     * @param AuthService $authService
     * @param AuthRepository $authRepository
     * @param UserRepository $userRepository
     * @param EmailService $emailService
     */
    public function __construct(UserProfileService $userProfileService, AuthService $authService, AuthRepository $authRepository, UserRepository $userRepository, EmailService $emailService)
    {
        $this->userProfileService = $userProfileService;
        $this->authRepository = $authRepository;
        $this->authService = $authService;
        $this->userRepository = $userRepository;
        $this->emailService = $emailService;
    }
    /**
     * createAccount
     *
     * @param Request $request
     * @return mixed    
     */
    public function createAccount(Request $request)
    {
        try {
            $this->emailService->saveUserCode($request->UserEmailCode);
            if ($this->emailService->checkCodes()) {
                $user = $this->authRepository->createNewUser(session('user_data'));
                Auth::login($user);
                $this->userRepository->create();
                return redirect('user/profile');
            }
            return redirect()->back()->with('error', 'Wrong code');
        } catch (\Exception $error) {
            Log::error($error);
        }
    }

    /**
     * prepareData
     * prepare user data to creating
     * @param AuthLoginRequest $request
     * @return mixed    
     */
    public function prepareData(AuthLoginRequest $request)
    {
        try {
            session(['user_data' => $request->validated()]);
            event(new UserCreating);
            return redirect('auth/reg/verificate-email');
        } catch (\Exception $error) {
            Log::error($error);
        }
    }
    /** 
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /**
     *  checkIfLog
     *
     * @param LoginRequest $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
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
