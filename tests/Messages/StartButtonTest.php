<?php
use Casperlaitw\LaravelFbMessenger\Messages\StartButton;
use Illuminate\Support\Str;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 下午4:57
 */
class StartButtonTest extends TestCase
{
    public function test_to_data()
    {
        $payload = Str::random();
        $expected = [
            'get_started' => [
                'payload' => $payload,
            ],
        ];

        $startButton = new StartButton($payload);
        $this->assertEquals($expected, $startButton->toData());
    }
}
