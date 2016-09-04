<?php
/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 上午12:48
 */

use Casperlaitw\LaravelFbMessenger\Collections\ButtonCollection;
use Casperlaitw\LaravelFbMessenger\Exceptions\RequiredArgumentException;
use Casperlaitw\LaravelFbMessenger\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Transformers\ButtonTransformer;
use Mockery as m;
use pimax\Messages\MessageButton;
use pimax\Messages\StructuredMessage;

class ButtonTransformerTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function test_transform()
    {
        $testSender = str_random();
        $testText = 'abc';
        $testCase = [
            new MessageButton(MessageButton::TYPE_POSTBACK, 'test1', 'test1'),
            new MessageButton(MessageButton::TYPE_WEB, 'test2', 'test2'),
        ];

        $expected = new StructuredMessage(
            $testSender,
            StructuredMessage::TYPE_BUTTON,
            [
                'text' => $testText,
                'buttons' => $testCase,
            ]
        );

        $transformer = new ButtonTransformer();
        $actual = $transformer->transform($this->createMessageMock($testCase, $testSender, $testText));
        $this->assertInstanceOf(StructuredMessage::class, $actual);
        $this->assertEquals($expected->getData(), $actual->getData());
    }

    public function test_empty_text_and_exception()
    {
        $this->expectException(RequiredArgumentException::class);
        $transformer = new ButtonTransformer();
        $transformer->transform($this->createMessageMock([], null, ''));
    }

    private function createMessageMock($testCase, $testSender, $testText)
    {
        $buttons = m::mock(ButtonCollection::class)
            ->shouldReceive('getElements')
            ->andReturn($testCase)
            ->getMock();
        $message = m::mock(Message::class)
            ->shouldReceive('getSender')
            ->andReturn($testSender)
            ->shouldReceive('getText')
            ->andReturn($testText)
            ->shouldReceive('getCollections')
            ->andReturn($buttons)
            ->getMock();

        return $message;
    }
}
