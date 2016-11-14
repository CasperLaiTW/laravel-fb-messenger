<?php
use Casperlaitw\LaravelFbMessenger\Exceptions\UnknownTypeException;
use Casperlaitw\LaravelFbMessenger\Messages\Button;

/**
 * User: casperlai
 * Date: 2016/9/16
 * Time: 上午12:51
 */
class ButtonTest extends TestCase
{
    public function test_share_button()
    {
        $button = new Button(Button::TYPE_SHARE, '');
        $expected = [
            'type' => 'element_share',
        ];
        $this->assertEquals($expected, $button->toData());
    }

    public function test_unknown_type_button()
    {
        $this->expectException(UnknownTypeException::class);

        $button = new Button('unknown', '');
        $button->toData();
    }

    public function test_set_extra()
    {
        $button = new Button(Button::TYPE_WEB, 'title', 'url');
        $button->setExtra(['extra' => 'test']);

        $expected = [
            'type' => 'web_url',
            'title' => 'title',
            'url' => 'url',
            'extra' => 'test',
        ];

        $this->assertEquals($expected, $button->toData());
    }
}
