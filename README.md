# Laravel Facebook Messenger Provider
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

```php
<?php

use Casperlaitw\LaravelFbMessenger\Contracts\BaseHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;

class DefaultHandler extends BaseHandler
{
    /**
     *  handle method is required. 
     */
    public function handle()
    {
        $this->messages->each(function (ReceiveMessage $message) {
            /**
             *  Condition to anything you want and reply message to user
             */
            $this->send(new Text($message->getSender(), "Default Handler: {$message->getMessage()}"));
        });
    }
}
```

### API
[wiki](wiki)

### License

This package is licensed under the [MIT license](https://github.com/CasperLaiTW/laravel-fb-messenger/blob/master/LICENSE.md).