<?php
return [
    'debug' => env('APP_DEBUG', false),
    'verify_token' => env('MESSENGER_VERIFY_TOKEN'),
    'app_token' => env('MESSENGER_APP_TOKEN'),
    'app_secret' => env('MESSENGER_APP_SECRET'),
    'auto_typing' => true,
    'handlers' => [
        Casperlaitw\LaravelFbMessenger\Contracts\DefaultHandler::class
    ],
    'custom_url' => '/webhook',
    'postbacks' => [],
    'home_url' => [
        'url' => env('MESSENGER_HOME_URL'),
         'webview_share_button' => 'show',
         'in_test' => true,
    ],
];
