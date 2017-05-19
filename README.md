# Laravel Facebook Messenger Provider
[![Build Status](https://travis-ci.org/CasperLaiTW/laravel-fb-messenger.svg)](https://travis-ci.org/CasperLaiTW/laravel-fb-messenger)
[![Coverage Status](https://coveralls.io/repos/github/CasperLaiTW/laravel-fb-messenger/badge.svg)](https://coveralls.io/github/CasperLaiTW/laravel-fb-messenger)
[![StyleCI](https://styleci.io/repos/66968888/shield)](https://styleci.io/repos/66968888)
[![Latest Stable Version](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/v/stable)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)
[![Latest Unstable Version](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/v/unstable)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)
[![Total Downloads](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/downloads)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)
[![Monthly Downloads](https://poser.pugx.org/casperlaitw/laravel-fb-messenger/d/monthly)](https://packagist.org/packages/casperlaitw/laravel-fb-messenger)

This is a laravel package for Facebook Messenger Platform API.

Easy to making your facebook messenger chatbot.

## Installation

### Composer

```shell
composer require casperlaitw/laravel-fb-messenger
```

## Laravel

### Add Provider
In your `config/app.php` add  `Casperlaitw\LaravelFbMessenger\LaravelFbMessengerServiceProvider::class` to the providers array:
```php
'providers' => [
    ...
    Casperlaitw\LaravelFbMessenger\LaravelFbMessengerServiceProvider::class,
    ...
],

'alias => [
    ...
    'Menu' => Casperlaitw\LaravelFbMessenger\Facades\MessengerMenu::class,
    ...
],
```

### Publish Configuration
```shell
php artisan vendor:publish --provider="Casperlaitw\LaravelFbMessenger\LaravelFbMessengerServiceProvider" --tag="config"
```

### Publish Menu Configure
Support define persistent menu in file.

Define persistent menu like laravel routes.

[document](https://github.com/CasperLaiTW/laravel-fb-messenger/wiki/Commands#fbmenus)

```shell
php artisan vendor:publish --provider="Casperlaitw\LaravelFbMessenger\LaravelFbMessengerServiceProvider" --tag="menu"
```

## Configuration 

### Security

Almost every API request with `access_token`, if you want to improved security in your app,
you can use `appsecret_proof`. Please add `MESSENGER_APP_SECRET` to `.env` file and enable proof on all calls.
*If you don't know how to get secret token and enabled proof, please checkout [Graph Api](https://developers.facebook.com/docs/graph-api/securing-requests)*

`.env`
```
MESSENGER_APP_SECRET="APP SECRET TOKEN"
```

### Token
Add you token to `.env` file or modify `fb-messenger.php` config.

*If you don't know how to get token, please checkout [Facebook Developer](https://developers.facebook.com/docs/messenger-platform/quickstart)*


`.env`
```
...
MESSENGER_VERIFY_TOKEN="By You Writing"
MESSENGER_APP_TOKEN="Page Access Token"
...
```

### Custom Url
If you want to custom url, replace `/webhook` to you want.

Finally, you can run `php artisan route:list` to check.

```php
 return [
     'verify_token' => env('MESSENGER_VERIFY_TOKEN'),
     'app_token' => env('MESSENGER_APP_TOKEN'),
     'auto_typing' => true,
     'handlers' => [App\DefaultHandler::class],
     'custom_url' => '/chatbot', // like this
     'postbacks' => [],
 ];
```

### Custom Handler
The `DefaultHandler` will reply the same words to user.

You can check out [DefaultHandler](https://github.com/CasperLaiTW/laravel-fb-messenger/blob/master/src/Contracts/DefaultHandler.php)

Handler **MUST BE** extends `BaseHandler`.

```php
<?php

namespace App;

use Casperlaitw\LaravelFbMessenger\Contracts\BaseHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Casperlaitw\LaravelFbMessenger\Messages\Text;

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

## Postback Handler

### Create your postback handler

`$payload` is you setting that [fb:get-start](https://github.com/CasperLaiTW/laravel-fb-messenger/wiki/Commands#fbget-start) command or [button message's postback button](https://github.com/CasperLaiTW/laravel-fb-messenger/wiki/Example#button-message) etc.

`$payload` support regex or string.

```php
<?php

namespace App;

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

### Add to `fb-messenger.php` config

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

## Debug Route
The debug route using [Pusher](https://pusher.com/)

![debug-route](https://cdn.rawgit.com/CasperLaiTW/laravel-fb-messenger/master/docs/images/debug-route.gif)

### Configure your `.env`
```
  APP_DEBUG=true
  BROADCAST_DRIVER=pusher
  PUSHER_APP_ID=
  PUSHER_KEY=
  PUSHER_SECRET=
```

### Publish script
**If package updated, you need to run this script again. Keep your javascript is up-to-date**
```shell
php artisan vendor:publish --provider="Casperlaitw\LaravelFbMessenger\LaravelFbMessengerServiceProvider" --tag="public" --force
```

### Open browser
```url
http://[your-site]/fb-messenger/debug
```

## API
[API Document](https://casperlaitw.github.io/laravel-fb-messenger/)

## Commands
See the [document](https://github.com/CasperLaiTW/laravel-fb-messenger/wiki/Commands)

## License

This package is licensed under the [MIT license](https://github.com/CasperLaiTW/laravel-fb-messenger/blob/master/LICENSE.md).