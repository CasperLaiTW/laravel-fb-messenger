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

    public function test_set_location()
    {
        $expected = [
            'content_type' => 'location',
        ];

        $this->assertEquals($expected, (new QuickReply(null, null))->setLocation()->toData());
    }

    public function test_set_image()
    {
        $title = 'Red';
        $payload = 'PAYLOAD_RED';
        $image = str_random();

        $expected = [
            'content_type' => 'text',
            'title' => $title,
            'payload' => $payload,
            'image_url' => $image,
        ];

        $this->assertEquals($expected, (new QuickReply($title, $payload))->setImage($image)->toData());
    }
}
