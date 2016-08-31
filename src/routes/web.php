<?php

Route::get(config('fb-messenger.custom_url', '/webhook'), 'WebhookController@index');
Route::post(config('fb-messenger.custom_url', '/webhook'), 'WebhookController@receive');
