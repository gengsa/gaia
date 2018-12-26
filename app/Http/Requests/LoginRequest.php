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
            'username' => 'required',
            'password' => 'required',
        ];
    }
}
