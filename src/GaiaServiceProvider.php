<?php

namespace Gaia;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;

class GaiaServiceProvider extends ServiceProvider
{
    use ServiceBindings;

    protected $providers = [
        Providers\AppServiceProvider::class,
        Providers\AuthServiceProvider::class,
        // Providers\BroadcastServiceProvider::class,
        Providers\EventServiceProvider::class,
        Providers\RouteServiceProvider::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->registerRoutes();
        $this->registerResources();
    }

    
    

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        defined('GAIA_PATH') || define('GAIA_PATH', realpath(__DIR__.'/../'));

        $this->configure();
//         $this->offerPublishing();
        $this->registerServices();
        $this->registerProviders();
//         $this->registerCommands();
//         $this->registerQueueConnectors();
    }

    /**
     * Register the Gaia routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        // Gaia's route is registed in $this->->registerProviders(),
        // considering whether it is appropriate
    }

    /**
     * Register the Gaia resources.
     *
     * @return void
     */
    protected function registerResources()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'gaia');
    }

    /**
     * Setup the configuration for Gaia.
     *
     * @return void
     */
    protected function configure()
    {
        // merge all configuration files
        // TODO: maybe need array merge recursively
        
        $files = [];
        // TODO: checck config dir path
        $configPath = __DIR__ . '/../config';
        /**
         * @var $file \SplFileInfo
         */
        foreach (Finder::create()->files()->name('*.php')->in($configPath) as $file) {
            $this->mergeConfigFrom($file->getPathname(), $file->getBasename('.php'));
        }
    }

    /**
     * Register Gaia's services in the container.
     *
     * @return void
     */
    protected function registerServices()
    {
        foreach ($this->serviceBindings as $key => $value) {
            is_numeric($key)
            ? $this->app->singleton($value)
            : $this->app->singleton($key, $value);
        }
    }

    /**
     * Register Gaia services providers.
     *
     * @return void
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->app->register($provider);
        }
    }
}
