<?php

use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Mockery as m;
use pimax\Messages\StructuredMessage;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 上午1:58
 */
class ButtonTest extends PHPUnit_Framework_TestCase
{
    private $testSender;

    private $testText;

    private $testCase;

    public function setUp()
    {
        $this->testSender = str_random();
        $this->testText = 'abc';
        $this->testCase = new Button($this->testSender, $this->testText);
    }
    public function tearDown()
    {
        m::close();
    }

    public function test_to_data()
    {
        $expected = new StructuredMessage(
            $this->testSender,
            StructuredMessage::TYPE_BUTTON,
            [
                'text' => $this->testText,
                'buttons' => [],
            ]
        );
        $this->assertEquals($expected->getData(), $this->testCase->toData()->getData());
    }

    public function test_get_text()
    {
        $this->assertEquals($this->testText, $this->testCase->getText());
    }

    public function test_set_text()
    {
        $expected = 'change_text';
        $this->testCase->setText($expected);

        $this->assertEquals($expected, $this->testCase->getText());
    }
}
