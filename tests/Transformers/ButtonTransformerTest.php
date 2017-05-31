<?php
/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 上午12:48
 */

use Casperlaitw\LaravelFbMessenger\Collections\ButtonCollection;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Template;
use Casperlaitw\LaravelFbMessenger\Exceptions\RequiredArgumentException;
use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Casperlaitw\LaravelFbMessenger\Transformers\ButtonTransformer;
use Mockery as m;

class ButtonTransformerTest extends TestCase
{
    public function test_transform()
    {
        $testSender = str_random();
        $testText = 'abc';
        $testCase = [
            new Button(Button::TYPE_POSTBACK, 'test1', 'test1'),
            new Button(Button::TYPE_WEB, 'test2', 'test2'),
        ];

        $buttonExpected = [];
        foreach ($testCase as $case) {
            $buttonExpected[] = $case->toData();
        }

        $expected = [
            'template_type' => 'button',
            'text' => $testText,
            'buttons' => $buttonExpected,
        ];

        $transformer = new ButtonTransformer();
        $actual = $transformer->transform($this->createMessageMock($testCase, $testSender, $testText));
        $this->assertEquals($expected, $actual);
    }

    public function test_empty_text_and_exception()
    {
        $this->expectException(RequiredArgumentException::class);
        $transformer = new ButtonTransformer();
        $transformer->transform($this->createMessageMock([], null, ''));
    }

    private function createMessageMock($testCase, $testSender, $testText)
    {
        $collection = new ButtonCollection($testCase);

        $message = m::mock(Template::class)
            ->shouldReceive('getSender')
            ->andReturn($testSender)
            ->shouldReceive('getText')
            ->andReturn($testText)
            ->shouldReceive('getCollections')
            ->andReturn($collection)
            ->getMock();

        return $message;
    }
}
