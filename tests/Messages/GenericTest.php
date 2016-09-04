<?php

use Casperlaitw\LaravelFbMessenger\Messages\Element;
use Casperlaitw\LaravelFbMessenger\Messages\Generic;
use pimax\Messages\StructuredMessage;

/**
 * User: casperlai
 * Date: 2016/9/4
 * Time: 上午12:45
 */
class GenericTest extends TestCase
{
    private $sender;

    private $case;

    public function setUp()
    {
        $this->sender = str_random();
        $this->case = [
            new Element('title1', 'description1'),
            new Element('title2', 'description2')
        ];
    }

    public function test_to_data()
    {
        $expected = new StructuredMessage(
            $this->sender,
            StructuredMessage::TYPE_GENERIC,
            [
                'elements' => collect($this->case)->map(function ($case) {
                    return $case->toData();
                })->toArray(),
            ]
        );

        $actual = new Generic($this->sender, $this->case);

        $this->assertEquals($expected, $actual->toData());
    }
}
