<?php

namespace Gaia\Providers;

use Illuminate\Support\ServiceProvider;
use Gaia\Models\Country;
use Gaia\Models\CustomCountry;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        // custom path.lang, use our own data from db
        $this->app->instance('path.lang', $this->app->storagePath() . '/app/lang');
        
        $this->app->bind(Country::class, CustomCountry::class);
    }
}
