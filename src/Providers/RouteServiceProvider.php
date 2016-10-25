<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午12:33
 */

namespace Casperlaitw\LaravelFbMessenger\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * Class RouteServiceProvider
 * @package Casperlaitw\LaravelFbMessenger\Providers
 */
class RouteServiceProvider extends ServiceProvider
{
    /**
     * Controller namespace
     * @var string
     */
    protected $namespace = 'Casperlaitw\LaravelFbMessenger\Controllers';

    /**
     * Register the webhook to router
     * @param Router $router
     */
    public function boot(Router $router)
    {
        if (!$this->app->routesAreCached()) {
            $router->group([
                'namespace' => $this->namespace,
            ], function (Router $router) {
                require __DIR__.'/../routes/web.php';
            });
        }
    }

    /**
     * Stub required to satisfy Laravel 5.1's ServiceProvider
     */
    public function register()
    {
        //
    }
}
