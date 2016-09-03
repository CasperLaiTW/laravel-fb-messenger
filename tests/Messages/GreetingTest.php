<?php
use Casperlaitw\LaravelFbMessenger\Messages\Greeting;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 下午4:59
 */
class GreetingTest extends PHPUnit_Framework_TestCase
{
    public function test_to_data()
    {
        $greetingText = str_random();
        $expected = [
            'setting_type'    => 'greeting',
            'greeting' => [
                'text' => $greetingText,
            ]
        ];

        $greeting = new Greeting($greetingText);
        $this->assertEquals($expected, $greeting->toData());
    }
}
