<?php

use Casperlaitw\LaravelFbMessenger\Messages\Element;
use Casperlaitw\LaravelFbMessenger\Messages\GenericTemplate;
use pimax\Messages\StructuredMessage;

/**
 * User: casperlai
 * Date: 2016/9/4
 * Time: 上午12:45
 */
class GenericTemplateTest extends TestCase
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
        $elementExpected = [];
        foreach ($this->case as $case) {
            $elementExpected[] = $case->toData();
        }
        $expected = [
            'recipient' => [
                'id' => $this->sender,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements' => $elementExpected,
                        'image_aspect_ratio' => 'horizontal',
                    ],
                ],
            ],
        ];

        $actual = new GenericTemplate($this->sender, $this->case);

        $this->assertEquals($expected, $actual->toData());
    }

    public function test_disable_share()
    {
        $elementExpected = [];
        foreach ($this->case as $case) {
            $elementExpected[] = $case->toData();
        }
        $expected = [
            'recipient' => [
                'id' => $this->sender,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements' => $elementExpected,
                        'sharable' => false,
                        'image_aspect_ratio' => 'horizontal',
                    ],
                ],
            ],
        ];

        $actual = new GenericTemplate($this->sender, $this->case);
        $actual->disableShare();

        $this->assertEquals($expected, $actual->toData());
    }

    public function test_image_ratio()
    {
        $elementExpected = [];
        foreach ($this->case as $case) {
            $elementExpected[] = $case->toData();
        }
        $expected = [
            'recipient' => [
                'id' => $this->sender,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'template',
                    'payload' => [
                        'template_type' => 'generic',
                        'elements' => $elementExpected,
                        'image_aspect_ratio' => 'square',
                    ],
                ],
            ],
        ];

        $actual = new GenericTemplate($this->sender, $this->case);
        $actual->setImageRatio(GenericTemplate::IMAGE_SQUARE);

        $this->assertEquals($expected, $actual->toData());
    }
}
