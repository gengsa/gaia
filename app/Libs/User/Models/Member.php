<?php

namespace Gaia\Libs\User\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class Member extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, MustVerifyEmail;

    const CREATED_AT = 'reg_time';

    const UPDATED_AT = 'last_modify_time';

    protected $table = 'members';

    protected $primaryKey = 'member_id';

//     protected $rememberTokenName = 'remember_token'; // TODO:

    /**
     * Get the password shadow for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password_shadow;
    }
}
