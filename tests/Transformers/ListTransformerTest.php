<?php

use Casperlaitw\LaravelFbMessenger\Collections\ElementCollection;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Template;
use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Casperlaitw\LaravelFbMessenger\Messages\Element;
use Casperlaitw\LaravelFbMessenger\Transformers\ListTransformer;
use Illuminate\Support\Str;
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
        $testSender = Str::random();
        $testCase = [
            new Element('title1', 'description2', 'image_url'),
            new Element('title2', 'description2', 'image_url'),
            new Element('title2', 'description2', 'image_url'),
        ];

        $testButton = new Button(Button::TYPE_WEB, 'title', 'http://www.google.com');

        $expectedCase = [];
        foreach ($testCase as $case) {
            $expectedCase[] = $case->toData();
        }

        $transformer = new ListTransformer();

        $expected = [
            'template_type' => 'list',
            'top_element_style' => 'large',
            'elements' => $expectedCase,
            'buttons' => [$testButton->toData()]
        ];


        $actual = $transformer->transform($this->createMessageMock($testCase, $testSender, $testButton));
        $this->assertEquals($expected, $actual);
    }

    public function test_transform_without_buttons()
    {
        $testSender = Str::random();
        $testCase = [
            new Element('title1', 'description2', 'image_url'),
            new Element('title2', 'description2', 'image_url'),
            new Element('title2', 'description2', 'image_url'),
        ];

        $expectedCase = [];
        foreach ($testCase as $case) {
            $expectedCase[] = $case->toData();
        }

        $transformer = new ListTransformer();

        $expected = [
            'template_type' => 'list',
            'top_element_style' => 'large',
            'elements' => $expectedCase,
        ];


        $actual = $transformer->transform($this->createMessageMock($testCase, $testSender, null));
        $this->assertEquals($expected, $actual);
    }

    private function createMessageMock($testCase, $testSender, $testButton)
    {
        $elements = new ElementCollection($testCase);

        $message = m::mock(Template::class)
            ->shouldReceive('getSender')->andReturn($testSender)
            ->shouldReceive('getCollections')->andReturn($elements)
            ->shouldReceive('getButton')->andReturn($testButton)
            ->shouldReceive('getTopStyle')->andReturn('large')
            ->getMock();

        return $message;
    }
}
