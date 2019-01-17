<?php

namespace Gaia;

use Gaia\Services\User\UserServiceInterface;
use Gaia\Services\User\UserService;
use Gaia\Services\Region\RegionServiceInterface;
use Gaia\Services\Region\RegionService;

trait ServiceBindings
{
    /**
     * All of the service bindings for Horizon.
     *
     * @var array
     */
    public $serviceBindings = [
        /*
         * Package Service Providers...
         */
        
//         /*
//          * Application Service Providers...
//          */
//         Providers\AppServiceProvider::class,
//         Providers\AuthServiceProvider::class,
//         // Providers\BroadcastServiceProvider::class,
//         Providers\EventServiceProvider::class,
//         Providers\RouteServiceProvider::class,
        
        
//         // General services...
//         AutoScaler::class,
//         Contracts\HorizonCommandQueue::class => RedisHorizonCommandQueue::class,
//         Listeners\TrimRecentJobs::class,
//         Listeners\TrimFailedJobs::class,
//         Lock::class,
//         Stopwatch::class,

//         // Repository services...
//         Contracts\JobRepository::class => Repositories\RedisJobRepository::class,

           // services
           UserServiceInterface::class => UserService::class,
           RegionServiceInterface::class => RegionService::class,
    ];
}