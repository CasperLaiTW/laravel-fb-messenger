<?php

use Casperlaitw\LaravelFbMessenger\Collections\ReceiveMessageCollection;
use Casperlaitw\LaravelFbMessenger\Messages\Receiver;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 下午4:39
 */
class ReceiverTest extends TestCase
{
    private static $postbackJson = '{ "object": "page", "entry": [ { "id": "1266802133337776", "time": 1472712592576, "messaging": [ { "recipient": { "id": "1266802133337776" }, "timestamp": 1472712592576, "sender": { "id": "1031304140280126" }, "postback": { "payload": "USER_DEFINED_PAYLOAD" } } ] } ] }';
    private static $messageJson = '{ "object": "page", "entry": [ { "id": "1266802133337776", "time": 1472653372870, "messaging": [ { "sender": { "id": "1031304140280126" }, "recipient": { "id": "1266802133337776" }, "timestamp": 1472653364156, "message": { "mid": "mid.1472653364072:a0567094fd740c2a63", "seq": 208, "text": "fsadfjojiwejf" } } ] } ] }';
    public function test_get_message()
    {
        $receiver = new Receiver($this->createRequestMock(self::$messageJson));
        $this->assertInstanceOf(ReceiveMessageCollection::class, $receiver->getMessages());
        $actual = $receiver->getMessages()->first();
        $this->assertEquals('fsadfjojiwejf', $actual->getMessage());
        $this->assertFalse($actual->isSkip());
        $this->assertFalse($actual->isPayload());
    }

    public function test_postback_message()
    {
        $receiver = new Receiver($this->createRequestMock(self::$postbackJson));
        $this->assertInstanceOf(ReceiveMessageCollection::class, $receiver->getMessages());
        $actual = $receiver->getMessages()->first();
        $this->assertEquals('USER_DEFINED_PAYLOAD', $actual->getPostback());
        $this->assertTrue($actual->isPayload());
    }

    private function createRequestMock($json)
    {
        $mock = m::mock(Request::class)
            ->shouldReceive('input')
            ->andReturnUsing(function () use ($json) {
                return Arr::get(json_decode($json, true), 'entry.0.messaging');
            })
            ->getMock();
        return $mock;
    }
}
