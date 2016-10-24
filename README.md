# Laravel Facebook Messenger Provider
[![Build Status](https://travis-ci.org/CasperLaiTW/laravel-fb-messenger.svg?branch=master)](https://travis-ci.org/CasperLaiTW/laravel-fb-messenger)
[![Coverage Status](https://coveralls.io/repos/github/CasperLaiTW/laravel-fb-messenger/badge.svg?branch=master)](https://coveralls.io/github/CasperLaiTW/laravel-fb-messenger?branch=master)
[![StyleCI](https://styleci.io/repos/66968888/shield)](https://styleci.io/repos/66968888)
[![Latest Stable Version](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/v/stable)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)
[![Latest Unstable Version](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/v/unstable)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)
[![Total Downloads](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/downloads)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)
[![Monthly Downloads](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/d/monthly)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)

Easy to making your facebook messenger chatbot.

## Installation

### Composer

```shell
composer require casperlaitw/laravel-fb-messenger
```

### Laravel

#### Add Provider
In your `config/app.php` add  `Casperlaitw\LaravelFbMessenger\LaravelFbMessengerServiceProvider::class` to the providers array:
```php
'providers' => [
    ...
    Casperlaitw\LaravelFbMessenger\LaravelFbMessengerServiceProvider::class,
    ...
],
```

#### Publish Configuration
```shell
php artisan vendor:publish --provider="Casperlaitw\LaravelFbMessenger\LaravelFbMessengerServiceProvider"
```

#### Configuration 

#### Token
Add you token to `.env` file or modify `fb-messenger.php` config.

*If you don't know how to get token, please checkout [Facebook Developer](https://developers.facebook.com/docs/messenger-platform/quickstart)*


`.env`
```
...
MESSENGER_VERIFY_TOKEN="By You Writing"
MESSENGER_APP_TOKEN="Page Access Token"
...
```

#### Auto Typing

![Typing](https://cdn.rawgit.com/CasperLaiTW/laravel-fb-messenger/master/docs/images/typing.png)

Auto typing is enabled by default.

If you don't want to enable, set `auto_typing` to `false`

```php
return [
    'verify_token' => env('MESSENGER_VERIFY_TOKEN'),
    'app_token' => env('MESSENGER_APP_TOKEN'),
    'auto_typing' => false,  // disabled
    'handlers' => [App\YourHandler::class],
    'postbacks' => [
        App\StartupPostback::class,
    ],
];    
```

#### Custom Url
If you want to custom url, replace `/webhook` to you want.

Finally, you can run `php artisan route:list` to check.

```php
 return [
     'verify_token' => env('MESSENGER_VERIFY_TOKEN'),
     'app_token' => env('MESSENGER_APP_TOKEN'),
     'auto_typing' => true,
     'handlers' => [App\YourHandler::class],
     'custom_url' => '/chatbot', // like this
     'postbacks' => [],
 ];
```

#### Custom Handler
The `DefaultHandler` will reply the same words to user.

You can check out [DefaultHandler](https://github.com/CasperLaiTW/laravel-fb-messenger/blob/master/src/Contracts/DefaultHandler.php)

Handler **MUST BE** extends `BaseHandler`.

```php
<?php

use Casperlaitw\LaravelFbMessenger\Contracts\BaseHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;

class DefaultHandler extends BaseHandler
{
    /**
     *  handle method is required. 
     */
    public function handle(ReceiveMessage $message)
    {
        $this->send(new Text($message->getSender(), "Default Handler: {$message->getMessage()}"));
    }
}
```

### Postback Handler

1. Create your postback handler

`$payload` is you setting that [fb:get-start](https://github.com/CasperLaiTW/laravel-fb-messenger/wiki/Commands#fbget-start) command or [button message's postback button](https://github.com/CasperLaiTW/laravel-fb-messenger/wiki/Example#button-message) etc.

`$payload` support regex or string.

```php
use Casperlaitw\LaravelFbMessenger\Contracts\PostbackHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Casperlaitw\LaravelFbMessenger\Messages\Text;

class StartupPostback extends PostbackHandler
{
    // If webhook get the $payload is `USER_DEFINED_PAYLOAD` will run this postback handler
    protected $payload = 'USER_DEFINED_PAYLOAD'; // You also can use regex!

    /**
     * Handle the chatbot message
     *
     * @param ReceiveMessage $message
     *
     * @return mixed
     */
    public function handle(ReceiveMessage $message)
    {
        $this->send(new Text($message->getSender(), "I got your payload"));
    }
}
```

2. Add to `fb-messenger.php` config

```php
return [
    'verify_token' => env('MESSENGER_VERIFY_TOKEN'),
    'app_token' => env('MESSENGER_APP_TOKEN'),
    'auto_typing' => true,
    'handlers' => [App\YourHandler::class],
    'postbacks' => [
        App\StartupPostback::class,
    ],
];
```

[Example](https://github.com/CasperLaiTW/laravel-fb-messenger/wiki/Example#postback-handler)

### API
[API Document](https://casperlaitw.github.io/laravel-fb-messenger/)

### Commands
See the [document](https://github.com/CasperLaiTW/laravel-fb-messenger/wiki/Commands)

### License

This package is licensed under the [MIT license](https://github.com/CasperLaiTW/laravel-fb-messenger/blob/master/LICENSE.md).