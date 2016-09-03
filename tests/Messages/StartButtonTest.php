<?php
use Casperlaitw\LaravelFbMessenger\Messages\StartButton;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 下午4:57
 */
class StartButtonTest extends PHPUnit_Framework_TestCase
{
    public function test_to_data()
    {
        $payload = str_random();
        $expected = [
            'setting_type'    => 'call_to_actions',
            'thread_state'    => 'new_thread',
            'call_to_actions' => [
                [
                    'payload' => $payload,
                ],
            ]
        ];

        $startButton = new StartButton($payload);
        $this->assertEquals($expected, $startButton->toData());
    }
}
