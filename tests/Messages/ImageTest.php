<?php
use Casperlaitw\LaravelFbMessenger\Messages\Image;
use Illuminate\Support\Str;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 下午4:32
 */
class ImageTest extends TestCase
{
    public function test_to_data()
    {
        $sender = Str::random();
        $image = Str::random();
        $expected = [
            'recipient' => [
                'id' => $sender,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'image',
                    'payload' => [
                        'url' => $image,
                    ],
                ],
            ],
        ];
        $this->assertEquals($expected, (new Image($sender, $image))->toData());
    }
}
