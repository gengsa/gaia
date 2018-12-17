<?php

namespace Gaia\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Gaia\Auth\CustomEloquentUserProvider;
use Gaia\Hashing\CustomPasswordMd5Hasher;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'Gaia\Model' => 'Gaia\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // custom password md5 hasher for Hash
        Hash::extend('md5', function (Application $app) {
            return new CustomPasswordMd5Hasher();
        });

        // custom elequent user provider for Auth
        Auth::provider('custom', function (Application $app, $config) {
            return new CustomEloquentUserProvider($app['hash'], $config['model']);
        });
    }
}
