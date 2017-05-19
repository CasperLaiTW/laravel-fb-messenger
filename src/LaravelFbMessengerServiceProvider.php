<?php

namespace Casperlaitw\LaravelFbMessenger;

use Casperlaitw\LaravelFbMessenger\Commands\DomainWhitelistingCommand;
use Casperlaitw\LaravelFbMessenger\Commands\GetStartButtonCommand;
use Casperlaitw\LaravelFbMessenger\Commands\GreetingTextCommand;
use Casperlaitw\LaravelFbMessenger\Commands\MessengerCodeCommand;
use Casperlaitw\LaravelFbMessenger\Commands\PersistentMenuCommand;
use Casperlaitw\LaravelFbMessenger\Contracts\Debug\Debug;
use Casperlaitw\LaravelFbMessenger\Contracts\Debug\Handler;
use Casperlaitw\LaravelFbMessenger\Providers\MenuServiceProvider;
use Casperlaitw\LaravelFbMessenger\Providers\RouteServiceProvider;
use Illuminate\Contracts\Debug\ExceptionHandler;
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
    protected $configPath = __DIR__ . '/../config/fb-messenger.php';

    /**
     * Menu path
     *
     * @var string
     */
    protected $menuPath = __DIR__ . '/../config/menu.php';

    /**
     * Perform post-registration booting of services.
     *
     * @throws \InvalidArgumentException
     */
    public function boot()
    {
        $this->publishes([
            $this->configPath => $this->app->configPath().'/fb-messenger.php',
        ], 'config');

        $this->publishes([
            $this->menuPath => $this->app->basePath().'/routes/menu.php',
        ], 'menu');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laravel-fb-messenger');
        $this->publishes([__DIR__.'/../public' => $this->app->basePath().'/public/vendor'], 'public');

        if ($this->app['config']->get('fb-messenger.debug')) {
            $this->app->extend(ExceptionHandler::class, function ($exceptionHandler, $app) {
                $debug = $app->make(Debug::class);
                return new Handler($exceptionHandler, $debug);
            });
        }
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
        $this->app->register(MenuServiceProvider::class);
        $this->app->singleton(Debug::class, Debug::class);
        $this->registerCommands();
    }

    /**
     * Register commands
     */
    private function registerCommands()
    {
        $this->commands([
            GreetingTextCommand::class,
            GetStartButtonCommand::class,
            PersistentMenuCommand::class,
            DomainWhitelistingCommand::class,
            MessengerCodeCommand::class,
        ]);
    }
}
