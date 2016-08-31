# Laravel Facebook Messenger Provider
[![Build Status](https://travis-ci.org/CasperLaiTW/laravel-fb-messenger.svg?branch=master)](https://travis-ci.org/CasperLaiTW/laravel-fb-messenger)
[![Coverage Status](https://coveralls.io/repos/github/CasperLaiTW/laravel-fb-messenger/badge.svg?branch=master)](https://coveralls.io/github/CasperLaiTW/laravel-fb-messenger?branch=master)
[![StyleCI](https://styleci.io/repos/66968888/shield)](https://styleci.io/repos/66968888)
[![Latest Stable Version](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/v/stable)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)
[![Latest Unstable Version](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/v/unstable)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)
[![Total Downloads](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/downloads)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)
[![Monthly Downloads](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/d/monthly)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)

Easy to making your facebook messenger chatbot

## Installation

### Composer

```shell
composer require casperlaitw/laravel-fb-messenger dev-master
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

#### Add Your Token
Add you token to `.env` file or modify `fb-messenger.php` config
```php
 return [
     'verify_token' => env('MESSENGER_VERIFY_TOKEN'),
     'app_token' => env('MESSENGER_APP_TOKEN'),
     'handler' => App\YourHandler::class,
 ];
```

#### Custom Handler
The `DefaultHandler` will reply the same words to user.

You can check out [DefaultHandler](https://github.com/CasperLaiTW/laravel-fb-messenger/blob/master/src/Contracts/DefaultHandler.php)

Handle **MUST BE** extends `BaseHandler`

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

### API
[wiki](https://github.com/CasperLaiTW/laravel-fb-messenger/wiki)

### License

This package is licensed under the [MIT license](https://github.com/CasperLaiTW/laravel-fb-messenger/blob/master/LICENSE.md).