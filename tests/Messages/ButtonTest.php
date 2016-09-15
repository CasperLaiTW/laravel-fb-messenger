<?php
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
        $title = str_random();
        $button = new Button(Button::TYPE_SHARE, '');
        $expected = [
            'type' => 'element_share',
        ];
        $this->assertEquals($expected, $button->toData());
    }
}
