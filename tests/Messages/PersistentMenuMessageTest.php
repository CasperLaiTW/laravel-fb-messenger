<?php

use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Casperlaitw\LaravelFbMessenger\Messages\PersistentMenuMessage;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/4
 * Time: 上午12:32
 */
class PersistentMenuMessageTest extends TestCase
{
    public function test_to_data()
    {
        $persistent = new PersistentMenuMessage([$this->getMessageButtonStub()]);
        $expected = [
            'setting_type' => 'call_to_actions',
            'thread_state' => 'existing_thread',
            'call_to_actions' => [[]],
        ];

        $this->assertEquals($expected, $persistent->toData());
    }

    private function getMessageButtonStub()
    {
        $mock = m::mock(Button::class)
            ->shouldReceive('toData')
            ->andReturn([])
            ->getMock();

        return $mock;
    }
}
