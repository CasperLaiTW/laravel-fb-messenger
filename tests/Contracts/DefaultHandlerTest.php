<?php

use Casperlaitw\LaravelFbMessenger\Contracts\DefaultHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/8
 * Time: 下午9:45
 */
class DefaultHandlerTest extends TestCase
{
    public function test_handle()
    {
        $bot = m::mock(Bot::class)
            ->shouldReceive('send')
            ->withAnyArgs()
            ->andReturnNull()
            ->getMock();
        $handler = new DefaultHandler();
        $this->getPrivateProperty(DefaultHandler::class, 'bot')->setValue($handler, $bot);

        $handler->handle(m::mock(ReceiveMessage::class)->makePartial());
    }
}
