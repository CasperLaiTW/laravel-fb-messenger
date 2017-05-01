<?php

namespace Casperlaitw\LaravelFbMessenger\Providers;

use Casperlaitw\LaravelFbMessenger\Facades\MessengerMenu;
use Casperlaitw\LaravelFbMessenger\PersistentMenu\Menu;
use Illuminate\Support\ServiceProvider;

/**
 * Class MenuServiceProvider
 * @package Casperlaitw\LaravelFbMessenger\PersistentMenu
 * @codeCoverageIgnore
 */
class MenuServiceProvider extends ServiceProvider
{
    /**
     *
     */
    public function boot()
    {
        $this->map();
    }

    /**
     *
     */
    public function register()
    {
        $this->app->singleton('fbMenu', function () {
            return new Menu();
        });
    }

    /**
     *
     */
    public function map()
    {
        if (file_exists("{$this->app->basePath()}/routes/menu.php")) {
            require "{$this->app->basePath()}/routes/menu.php";
        }
    }
}
