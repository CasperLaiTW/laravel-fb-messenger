<?php

$router->get($this->app['config']->get('fb-messenger.custom_url', '/webhook'), 'WebhookController@index');
$router->post($this->app['config']->get('fb-messenger.custom_url', '/webhook'), 'WebhookController@receive');
