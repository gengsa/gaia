<?php

namespace Gaia\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Gaia\Services\User\UserServiceInterface;
use Gaia\Http\Requests\LoginRequest;
use Gaia\Http\Controllers\ControllerBase;
use Illuminate\Http\Request;

class LoginController extends ControllerBase
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/'; // TODO

    /**
     * Get the login username to be used by the controller.
     * This filed from form is used to attampt login.
     * We want to login by email or login_Name.
     *
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }
    
    public function login(LoginRequest $request, UserServiceInterface $userService)
    {
        $username = $request->get('username');
        $password = $request->get('password');
        if ($userService->login($username, $password)) {
            return $this->sendLoginResponse($request);
        } else {
            return $this->sendFailedLoginResponse($request);
        }
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
        ?: response()->json([
            'status' => 0,
            'msg' => '',
            'data' => [
                'redirect' => $this->redirectTo, // TODO:
            ],
        ]);
    }
}
