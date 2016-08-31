<?php

use Casperlaitw\LaravelFbMessenger\Collections\ReceiveMessageCollection;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午12:42
 */
class ReceiveMessageCollectionTest extends PHPUnit_Framework_TestCase
{

    public function tearDown()
    {
        m::close();
    }

    public function test_filter_skip()
    {
        //dd($this->mockReceiveMessage(true));
        $messages = [
            $this->mockReceiveMessage(true),
            $this->mockReceiveMessage(false),
            $this->mockReceiveMessage(true),
        ];

        $collection = new ReceiveMessageCollection($messages);

        $this->assertCount(3, $collection->toArray());

        $this->assertCount(1, $collection->filterSkip()->toArray());
    }

    private function mockReceiveMessage($skip)
    {
        $mock = m::mock(ReceiveMessage::class)->shouldReceive('isSkip')->andReturn($skip)->getMock();
        return $mock;
    }
}