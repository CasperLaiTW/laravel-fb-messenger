<?php

use Casperlaitw\LaravelFbMessenger\Messages\MessengerCode;

class MessengerCodeTest extends TestCase
{
    public function test_to_data()
    {
        $messengerCode = new MessengerCode();
        $messengerCode->setImageSize(2000);
        $messengerCode->setRef('test-on-set-ref');

        $expected = [
            'type' => 'standard',
            'image_size' => 2000,
            'data' => [
                'ref' => 'test-on-set-ref',
            ],
        ];

        $this->assertEquals($expected, $messengerCode->toData());
    }
}
