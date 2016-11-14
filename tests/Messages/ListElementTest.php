<?php
use Casperlaitw\LaravelFbMessenger\Exceptions\DefaultActionInvalidTypeException;
use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Casperlaitw\LaravelFbMessenger\Messages\ListElement;
use Casperlaitw\LaravelFbMessenger\Messages\UrlButton;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/14
 * Time: 下午10:50
 */
class ListElementTest extends TestCase
{
    public function test_set_default_action()
    {
        $button = new UrlButton('title', 'http://www.google.com');

        $list = new ListElement('title', 'description', 'image');
        $list->setDefaultAction($button);

        $actual = $this->getPrivateProperty(ListElement::class, 'defaultAction')->getValue($list);

        $this->assertEquals($button, $actual);
    }

    public function test_to_data()
    {
        $button = new UrlButton('title', 'http://www.google.com');

        $list = new ListElement('title', 'description', 'image');
        $list->setDefaultAction($button);

        $expected = [
            'title' => 'title',
            'subtitle' => 'description',
            'image_url' => 'image',
            'default_action' => [
                'type' => 'web_url',
                'url' => 'http://www.google.com',
            ],
        ];

        $this->assertEquals($expected, $list->toData());
    }
}
