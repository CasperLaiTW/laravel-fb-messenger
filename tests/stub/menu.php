<?php

use Casperlaitw\LaravelFbMessenger\Messages\UrlButton;

$menu->locale('default', function () use ($menu) {
    $menu->postback('Test Button', 'TEST_POSTBACK');
    $menu->webUrl('WebUrl', 'https://github.com/CasperLaiTW/laravel-fb-messenger');

    $menu->nested('SubMenu', function () use ($menu) {
        $menu->postback('SubMenu-Button', 'TEST_SUB_BUTTON');
        $menu->webUrl(new UrlButton('SubMenu-WebUrl', 'https://github.com/CasperLaiTW/laravel-fb-messenger'));
    });
});

$menu->locale('zh_TW', function () use ($menu) {
    $menu->disableInput();
    $menu->postback('zh_TW Test Button', 'TEST_POSTBACK');
    $menu->postback('zh_TW Test Button', 'TEST_POSTBACK');
    $menu->postback('zh_TW Test Button', 'TEST_POSTBACK');
});
