<?php
use Casperlaitw\LaravelFbMessenger\Messages\Greeting;
use Illuminate\Support\Str;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 下午4:59
 */
class GreetingTest extends TestCase
{
    public function test_to_data()
    {
        $greetingText = Str::random();
        $expected = [
            'greeting' => [
                [
                    'locale' => 'default',
                    'text' => $greetingText,
                ],
            ],
        ];

        $greeting = new Greeting([['locale' => 'default', 'text' => $greetingText]]);
        $this->assertEquals($expected, $greeting->toData());
    }
}
