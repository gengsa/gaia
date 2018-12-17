<?php

namespace Gaia\Auth;

use Illuminate\Auth\EloquentUserProvider;

use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Support\Str;
use Illuminate\Contracts\Support\Arrayable;

class CustomEloquentUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {

        if (empty($credentials) || (count($credentials) === 1 && array_key_exists('password', $credentials))) {
            return;
        }
                
        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery();

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
                continue;
            }

            if ($key == 'username') {
                // when use username, search in both login_name and email
                $query->where(function ($query) use ($value) {
                    $query->where('login_name', $value)
                        ->orWhere('email', $value);
                });
            } else {
                if (is_array($value) || $value instanceof Arrayable) {
                    $query->whereIn($key, $value);
                } else {
                    $query->where($key, $value);
                }
            }
        }

        return $query->first();
    }

    /**
     * custom md5 password validation
     * {@inheritDoc}
     * @see \Illuminate\Auth\EloquentUserProvider::validateCredentials()
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $loginName = $user->login_name;
        $regTime = $user->reg_time;
        $plain = $credentials['password'];

        return $this->hasher->check($plain, $user->getAuthPassword(), [
            'login_name' => $loginName,
            'reg_time' => $regTime,
        ]);
    }
}
