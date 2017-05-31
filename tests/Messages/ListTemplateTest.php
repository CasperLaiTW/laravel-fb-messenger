<?php
use Casperlaitw\LaravelFbMessenger\Exceptions\ListElementCountException;
use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Casperlaitw\LaravelFbMessenger\Messages\ListElement;
use Casperlaitw\LaravelFbMessenger\Messages\ListTemplate;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/14
 * Time: 下午10:59
 */
class ListTemplateTest extends TestCase
{
    private $sender;
    private $case;
    private $button;

    public function setUp()
    {
        $this->sender = str_random();
        $this->case = [
            new ListElement('title1', 'description1', 'image1'),
            new ListElement('title2', 'description2', 'image2'),
        ];
        $this->button = new Button(Button::TYPE_POSTBACK, 'GET_MORE');
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
                        'template_type' => 'list',
                        'top_element_style' => 'compact',
                        'elements' => $elementExpected,
                        'buttons' => [$this->button->toData()],
                    ],
                ],
            ],
        ];

        $actual = new ListTemplate($this->sender, $this->case);
        $actual->setTopStyle(ListTemplate::STYLE_COMPACT);
        $actual->setButton($this->button);
        $this->assertEquals($expected, $actual->toData());
    }

    public function test_to_data_fail()
    {
        $this->expectException(ListElementCountException::class);
        $actual = new ListTemplate($this->sender, []);
        $actual->toData();
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
                        'template_type' => 'list',
                        'top_element_style' => 'compact',
                        'elements' => $elementExpected,
                        'buttons' => [$this->button->toData()],
                        'sharable' => false,
                    ],
                ],
            ],
        ];

        $actual = new ListTemplate($this->sender, $this->case);
        $actual->setTopStyle(ListTemplate::STYLE_COMPACT);
        $actual->setButton($this->button);
        $actual->disableShare();
        $this->assertEquals($expected, $actual->toData());
    }
}
