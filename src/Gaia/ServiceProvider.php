<?php

namespace Gaia;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * {@inheritDoc}
     * @see \Illuminate\Support\ServiceProvider::mergeConfigFrom()
     */
    protected function mergeConfigFrom($path, $key)
    {
        $config = $this->app['config']->get($key, []);
        $this->app['config']->set($key, array_merge_recursive(require $path, $config));
    }

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
        // merge all configuration files
        $configDir = __DIR__ . '/../config';
        $configFiles = scandir($configDir);
        foreach ($configFiles as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            if (is_file($file)) {
                $configPath = $configDir . $file;
                $this->mergeConfigFrom($configPath, explode($file, '.')[0]);
            }
        }


    }
}