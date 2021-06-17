<?php

namespace Fifthgate\Objectivity\StringTokens\Laravel\Provider;

use Illuminate\Support\ServiceProvider;
use Fifthgate\Objectivity\StringTokens\Service\Interfaces\TokenServiceInterface;
use Fifthgate\Objectivity\StringTokens\Service\TokenService;
use Fifthgate\Objectivity\StringTokens\Service\Factories\StringTokenServiceFactory;
use Fifthgate\Objectivity\StringTokens\Laravel\Commands\CreateStringToken;

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
                __DIR__.'../../../../config/objectivity-string-tokens-config.php' => config_path('objectivity-string-tokens-config.php'),
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
        $this->commands([
            CreateStringToken::class
        ]);

        $this->mergeConfigFrom(
            __DIR__.'../../../../config/objectivity-string-tokens-config.php',
            'objectivity-string-tokens'
        );

        $this->app->singleton(
            TokenServiceInterface::class,
            function ($app) {
                $factory = new StringTokenServiceFactory;
                return $factory(config('objectivity-string-tokens'), config('app.debug', false));
            }
        );
    }
}
