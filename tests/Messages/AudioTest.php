<?php

use Casperlaitw\LaravelFbMessenger\Messages\Audio;
use Faker\Factory;

/**
 * User: casperlai
 * Date: 2016/9/14
 * Time: 下午10:49
 */
class AudioTest extends TestCase
{
    public function test_to_data()
    {
        $faker = Factory::create();
        $sender = str_random();
        $url = $faker->url;

        $actual = new Audio($sender, $url);

        $expected = [
            'recipient' => [
                'id' => $sender,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'audio',
                    'payload' => [
                        'url' => $url,
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $actual->toData());
    }
}
