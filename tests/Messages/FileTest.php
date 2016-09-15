<?php
use Casperlaitw\LaravelFbMessenger\Messages\File;
use Faker\Factory;

/**
 * User: casperlai
 * Date: 2016/9/14
 * Time: 下午11:43
 */
class FileTest extends TestCase
{
    public function test_to_data()
    {
        $faker = Factory::create();
        $sender = str_random();
        $url = $faker->url;

        $actual = new File($sender, $url);

        $expected = [
            'recipient' => [
                'id' => $sender,
            ],
            'message' => [
                'attachment' => [
                    'type' => 'file',
                    'payload' => [
                        'url' => $url,
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $actual->toData());
    }
}
