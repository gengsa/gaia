<?php

namespace Gaia\Providers;

use Illuminate\Support\ServiceProvider;

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
        var_dump('gaia boot');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // merge all configuration files
        // TODO: maybe need array merge recursively
        $configDir = __DIR__ . '/../../../config';

        $configFiles = scandir($configDir);
        foreach ($configFiles as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            $configPath = $configDir . '/' . $file;
            if (is_file($configPath)) {
                $this->mergeConfigFrom($configPath, explode('.', $file)[0]);
            }
        }
        var_dump('gaia register');
    }
}
