<?php

use Casperlaitw\LaravelFbMessenger\Messages\ButtonTemplate;
use Mockery as m;
use pimax\Messages\StructuredMessage;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 上午1:58
 */
class ButtonTemplateTest extends TestCase
{
    private $sender;

    private $text;

    private $case;

    public function setUp()
    {
        $this->sender = str_random();
        $this->text = 'abc';
        $this->case = new ButtonTemplate($this->sender, $this->text);
    }

    public function test_to_data()
    {
        $expected = [
            'recipient' => [
                'id' => $this->sender,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'button',
                        'text' => $this->text,
                        'buttons' => []
                    ],
                ]
            ],
        ];
        $this->assertEquals($expected, $this->case->toData());
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

    public function test_disable_share()
    {
        $expected = [
            'recipient' => [
                'id' => $this->sender,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'button',
                        'text' => $this->text,
                        'buttons' => [],
                        'sharable' => false,
                    ],
                ]
            ],
        ];
        $this->case->disableShare();
        $this->assertEquals($expected, $this->case->toData());
    }
}
