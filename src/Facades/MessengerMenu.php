<?php

namespace Casperlaitw\LaravelFbMessenger\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class MessengerMenu
 * @package Casperlaitw\LaravelFbMessenger\Facades
 * @codeCoverageIgnore
 */
class MessengerMenu extends Facade
{
    /**
     * The name of the binding in the IoC container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'fbMenu';
    }
}
