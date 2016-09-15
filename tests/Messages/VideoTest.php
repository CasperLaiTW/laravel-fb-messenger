<?php
use Casperlaitw\LaravelFbMessenger\Messages\Video;
use Faker\Factory;

/**
 * User: casperlai
 * Date: 2016/9/14
 * Time: 下午11:42
 */
class VideoTest extends TestCase
{
    public function test_to_data()
    {
        $faker = Factory::create();
        $sender = str_random();
        $url = $faker->url;

        $actual = new Video($sender, $url);

        $expected = [
            'recipient' => [
                'id' => $sender,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'video',
                    'payload' => [
                        'url' => $url,
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $actual->toData());
    }
}
