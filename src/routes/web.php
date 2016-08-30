<?php

Route::get('/webhook', 'WebhookController@index');
Route::post('/webhook', 'WebhookController@receive');
