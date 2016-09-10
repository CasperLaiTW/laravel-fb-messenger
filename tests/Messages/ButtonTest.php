<?php

use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Mockery as m;
use pimax\Messages\StructuredMessage;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 上午1:58
 */
class ButtonTest extends TestCase
{
    private $sender;

    private $text;

    private $case;

    public function setUp()
    {
        $this->sender = str_random();
        $this->text = 'abc';
        $this->case = new Button($this->sender, $this->text);
    }

    public function test_to_data()
    {
        $expected = new StructuredMessage(
            $this->sender,
            StructuredMessage::TYPE_BUTTON,
            [
                'text' => $this->text,
                'buttons' => [],
            ]
        );
        $this->assertEquals($expected->getData(), $this->case->toData()->getData());
    }

    public function test_get_text()
    {
        $this->assertEquals($this->text, $this->case->getText());
    }

    public function test_set_text()
    {
        $expected = 'change_text';
        $this->case->setText($expected);

        $this->assertEquals($expected, $this->case->getText());
    }
}
