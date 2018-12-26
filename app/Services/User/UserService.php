<?php
namespace Gaia\Services\User;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Support\Facades\Auth;

class UserService implements UserServiceInterface {

    use ThrottlesLogins;

    /**
     * 
     * {@inheritDoc}
     * @see \Gaia\Services\User\UserServiceInterface::login()
     */
    public function login($username, $password): bool
    {
        // TODO: judge too many login attempts
        
        $credentials = [
            'username' => $username,
            'password' => $password,
            // TODO: another status field
        ];
        $success = Auth::guard()->attempt($credentials, false);
        // if false, increment login attempts
        return $success;
    }
}