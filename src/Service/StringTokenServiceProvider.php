<?php

namespace Fifthgate\Objectivity\StringTokens\Service;

use Illuminate\Support\ServiceProvider;
use Fifthgate\Objectivity\StringTokens\Service\Interfaces\TokenServiceInterface;
use Fifthgate\Objectivity\StringTokens\Service\TokenService;

class StringTokenServiceProvider extends ServiceProvider
{
    /**
    * Bootstrap the application services.
    *
    * @return void
    */
    public function boot()
    {
        $this->publishes(
            [
                __DIR__.'/../config/objectivity-string-tokens-config.php' => config_path('objectivity-string-tokens-config.php'),
            ],
            'objectivity-string-tokens'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       
        $this->app->bind(
            TokenServiceInterface::class,
            TokenService::class
        );
    }
}
