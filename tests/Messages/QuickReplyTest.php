<?php
use Casperlaitw\LaravelFbMessenger\Messages\QuickReply;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/10/13
 * Time: 上午1:10
 */
class QuickReplyTest extends TestCase
{
    public function test_to_data()
    {
        $title = 'Red';
        $payload = 'PAYLOAD_RED';

        $expected = [
            'content_type' => 'text',
            'title' => $title,
            'payload' => $payload,
        ];

        $this->assertEquals($expected, (new QuickReply($title, $payload))->toData());
    }
}
