<?php

use Casperlaitw\LaravelFbMessenger\Collections\ReceiveMessageCollection;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午12:42
 */
class ReceiveMessageCollectionTest extends TestCase
{
    public function test_filter_skip()
    {
        $messages = [
            $this->createReceiveMessageMock(true),
            $this->createReceiveMessageMock(false),
            $this->createReceiveMessageMock(true),
        ];

        $collection = new ReceiveMessageCollection($messages);

        $this->assertCount(3, $collection->toArray());

        $this->assertCount(1, $collection->filterSkip()->toArray());
    }

    private function createReceiveMessageMock($skip)
    {
        $mock = m::mock(ReceiveMessage::class)->shouldReceive('isSkip')->andReturn($skip)->getMock();
        return $mock;
    }
}
