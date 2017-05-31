<?php

use Casperlaitw\LaravelFbMessenger\Collections\ElementCollection;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Template;
use Casperlaitw\LaravelFbMessenger\Messages\Element;
use Casperlaitw\LaravelFbMessenger\Transformers\GenericTransformer;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 上午1:35
 */
class GenericTransformerTest extends TestCase
{
    public function test_transform()
    {
        $testSender = str_random();
        $testCase = [
            new Element('title1', 'description2'),
            new Element('title2', 'description2', 'image_url'),
            new Element('title2', 'description2', 'image_url', 'url'),
        ];

        $expectedCase = [];
        foreach ($testCase as $case) {
            $expectedCase[] = $case->toData();
        }

        $transformer = new GenericTransformer;

        $expected = [
            'template_type' => 'generic',
            'image_aspect_ratio' => 'horizontal',
            'elements' => $expectedCase,
        ];


        $actual = $transformer->transform($this->createMessageMock($testCase, $testSender));
        $this->assertEquals($expected, $actual);
    }

    private function createMessageMock($testCase, $testSender)
    {
        $elements = new ElementCollection($testCase);

        $message = m::mock(Template::class)
            ->shouldReceive('getSender')->andReturn($testSender)
            ->shouldReceive('getCollections')->andReturn($elements)
            ->shouldReceive('getImageRatio')->andReturn('horizontal')
            ->getMock();

        return $message;
    }
}
