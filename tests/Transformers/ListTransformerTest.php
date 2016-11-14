<?php
use Casperlaitw\LaravelFbMessenger\Collections\ListElementCollection;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Casperlaitw\LaravelFbMessenger\Messages\ListElement;
use Casperlaitw\LaravelFbMessenger\Transformers\ListTransformer;
use Mockery as m;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/14
 * Time: 下午10:39
 */

class ListTransformerTest extends TestCase
{
    public function test_transform()
    {
        $testSender = str_random();
        $testCase = [
            new ListElement('title1', 'description2', 'image_url'),
            new ListElement('title2', 'description2', 'image_url'),
            new ListElement('title2', 'description2', 'image_url'),
        ];

        $testButton = new Button(Button::TYPE_WEB, 'title', 'http://www.google.com');

        $expectedCase = [];
        foreach ($testCase as $case) {
            $expectedCase[] = $case->toData();
        }

        $transformer = new ListTransformer();

        $expected = [
            'template_type' => 'list',
            'elements' => $expectedCase,
            'buttons' => [$testButton->toData()]
        ];


        $actual = $transformer->transform($this->createMessageMock($testCase, $testSender, $testButton));
        $this->assertEquals($expected, $actual);
    }

    private function createMessageMock($testCase, $testSender, $testButton)
    {
        $elements = new ListElementCollection($testCase);

        $message = m::mock(Message::class)
            ->shouldReceive('getSender')->andReturn($testSender)
            ->shouldReceive('getCollections')->andReturn($elements)
            ->shouldReceive('getButton')->andReturn($testButton)
            ->getMock();

        return $message;
    }
}
