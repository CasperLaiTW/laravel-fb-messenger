<?php

namespace Casperlaitw\LaravelFbMessenger;

use Casperlaitw\LaravelFbMessenger\Commands\GetStartButtonCommand;
use Casperlaitw\LaravelFbMessenger\Commands\GreetingTextCommand;
use Casperlaitw\LaravelFbMessenger\Providers\RouteServiceProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelFbMessengerServiceProvider
 * @package Casperlaitw\LaravelFbMessenger
 */
class LaravelFbMessengerServiceProvider extends ServiceProvider
{
    /**
     * Config path
     * @var string
     */
    protected $configPath = __DIR__.'/../config/fb-messenger.php';
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            $this->configPath => config_path('fb-messenger.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configPath, 'fb-messenger');
        $this->app->register(RouteServiceProvider::class);
        $this->registerCommands();
    }

    private function registerCommands()
    {
        $this->commands([
           GreetingTextCommand::class,
            GetStartButtonCommand::class,
        ]);
    }
}
