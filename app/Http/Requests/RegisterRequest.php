<?php

namespace Gaia\Http\Requests;

class RegisterRequest extends Request
{

    /**
     *
     * @return array
     */
    public function rules()
    {
        // TODO: to be same as js.
        return [
            'captcha' => 'required|captcha',
            'login_name' => ['required', 'string', 'max:255', 'unique:members'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:members'],
            // TODO: login_name and email both unique callback rule.
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'country' => ['required', 'numeric'],
            // TODO: create our own phone rule.
            'phone' => 'regex:/^([+][0-9]{1,3}([ .-])?)?([(][0-9]{1,6}[)])?([0-9 .-]{1,32})(([A-Za-z :]{1,11})?[0-9]{1,4}?)$/',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
        ];
    }
    
    // TODO: our own messages.
}
