<?php

$router->get($this->app['config']->get('fb-messenger.custom_url', '/webhook'), 'WebhookController@index');
$router->post($this->app['config']->get('fb-messenger.custom_url', '/webhook'), 'WebhookController@receive');
if ($this->app['config']->get('fb-messenger.debug')) {
    $router->get('fb-messenger/debug', 'DebugController@index');
}
