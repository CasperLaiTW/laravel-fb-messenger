<?php
use Casperlaitw\LaravelFbMessenger\Messages\UrlButton;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/14
 * Time: 下午11:39
 */
class UrlButtonTest extends TestCase
{
    public function test_use_messenger_extensions()
    {
        $button = new UrlButton('title', 'url');
        $button->useMessengerExtensions();

        $expected = [
            'type' => 'web_url',
            'title' => 'title',
            'url' => 'url',
            'messenger_extensions' => true,
        ];

        $this->assertEquals($expected, $button->toData());
    }

    public function test_set_fallback_url()
    {
        $button = new UrlButton('title', 'url');
        $button->setFallbackUrl('http://www.google.com');

        $expected = [
            'type' => 'web_url',
            'title' => 'title',
            'url' => 'url',
            'fallback_url' => 'http://www.google.com',
        ];

        $this->assertEquals($expected, $button->toData());
    }

    public function test_set_webview_height_ratio()
    {
        $button = new UrlButton('title', 'url');
        $button->setWebviewHeightRatio(UrlButton::TYPE_COMPACT);

        $expected = [
            'type' => 'web_url',
            'title' => 'title',
            'url' => 'url',
            'webview_height_ratio' => 'compact',
        ];

        $this->assertEquals($expected, $button->toData());
    }

    public function test_disable_share()
    {
        $button = new UrlButton('title', 'url');
        $button->disableShare();

        $expected = [
            'type' => 'web_url',
            'title' => 'title',
            'url' => 'url',
            'webview_share_button' => 'hide',
        ];

        $this->assertEquals($expected, $button->toData());
    }
}
