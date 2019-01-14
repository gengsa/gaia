<?php

namespace Gaia\Http\Requests;

class LoginRequest extends Request
{

    /**
     *
     * @return array
     */
    public function rules()
    {
        return [
            'captcha' => 'required|captcha',
            'username' => 'required',
            'password' => 'required',
        ];
    }
}
