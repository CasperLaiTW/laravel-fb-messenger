<?php
return [
    'verify_token' => env('MESSENGER_VERIFY_TOKEN'),
    'app_token' => env('MESSENGER_APP_TOKEN'),
    'handler' => Casperlaitw\LaravelFbMessenger\Contracts\DefaultHandler::class,
    'custom_url' => '/webhook',
    'postbacks' => [],
];
