<?php

use Casperlaitw\LaravelFbMessenger\Messages\Text;
use Illuminate\Support\Str;
use pimax\Messages\Message;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 下午4:30
 */
class TextTest extends TestCase
{
    public function test_to_data()
    {
        $sender = Str::random();
        $message = Str::random();
        $expected = [
            'recipient' =>  [
                'id' => $sender,
            ],
            'message' => [
                'text' => $message,
            ],
        ];

        $this->assertEquals($expected, (new Text($sender, $message))->toData());
    }
}
