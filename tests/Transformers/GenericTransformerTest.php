<?php

use Casperlaitw\LaravelFbMessenger\Collections\ElementCollection;
use Casperlaitw\LaravelFbMessenger\Messages\Element;
use Casperlaitw\LaravelFbMessenger\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Transformers\GenericTransformer;
use Mockery as m;
use pimax\Messages\StructuredMessage;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 上午1:35
 */
class GenericTransformerTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function test_transform()
    {
        $testSender = str_random();
        $testCase = [
            new Element('title1', 'description2'),
            new Element('title2', 'description2', 'image_url'),
            new Element('title2', 'description2', 'image_url', 'url'),
        ];

        foreach ($testCase as $case) {
            $expectedCase[] = $case->toData();
        }

        $transformer = new GenericTransformer;
        $expected = new StructuredMessage(
            $testSender,
            StructuredMessage::TYPE_GENERIC,
            [
                'elements' => $expectedCase,
            ]
        );

        $actual = $transformer->transform($this->createMessageMock($testCase, $testSender));
        $this->assertInstanceOf(StructuredMessage::class, $actual);
        $this->assertEquals($expected->getData(), $actual->getData());
    }

    private function createMessageMock($testCase, $testSender)
    {
        $elements = m::mock(ElementCollection::class)
            ->shouldReceive('toArray')->andReturnUsing(function () use ($testCase) {
                $data = [];
                foreach ($testCase as $case) {
                    $data[] = $case->toData();
                }

                return $data;
            })
            ->getMock();

        $message = m::mock(Message::class)
            ->shouldReceive('getSender')->andReturn($testSender)
            ->shouldReceive('getCollections')->andReturn($elements)
            ->getMock();

        return $message;
    }
}
