<?php

namespace Gaia\Http\Controllers\Auth;

use Gaia\Http\Controllers\ControllerBase;
use Gaia\Models\Member;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Gaia\Http\Requests\RegisterRequest;

class RegisterController extends ControllerBase
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        throw \Exception('use request to validate');
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $data = $request->all();
        var_dump($data);die;
        // TODO: write new register service in userService
//         event(new Registered($user = $this->create($request->all())));
        
        $this->guard()->login($user);
        
        return $this->registered($request, $user)
        ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \Gaia\Models\Member
     */
    protected function create($login_name, $password, $data)
    {
        $loginName = $data['name'];
        $email = $data['name'];
        $options = [
//             string            $login_name
//             \Carbon\Carbon    $reg_time
        ];
        var_dump($data);die;
        return Member::create([
            'name' => $data['name'],
            'email' => $data['email'],
            // password
            'password' => Hash::make($data['password']),
        ]);
    }
}
