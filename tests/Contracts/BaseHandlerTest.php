<?php

use Casperlaitw\LaravelFbMessenger\Contracts\BaseHandler;
use Casperlaitw\LaravelFbMessenger\Contracts\Bot;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Exceptions\NotCreateBotException;
use Casperlaitw\LaravelFbMessenger\Messages\Deletable;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/4
 * Time: 下午11:25
 */
class BaseHandlerTest extends TestCase
{
    public function test_send()
    {
        $bot = m::mock(Bot::class)
            ->shouldReceive('send')
            ->withAnyArgs()
            ->andReturnNull()
            ->getMock();
        $handler = $this->getMockForAbstractClass(BaseHandler::class);
        $this->getPrivateProperty(BaseHandler::class, 'bot')->setValue($handler, $bot);

        $message = new MessageStub(null);
        $message->setDelete(true);
        $handler->send($message);
    }

    public function test_bot_not_create()
    {
        $this->expectException(NotCreateBotException::class);
        $handler = $this->getMockForAbstractClass(BaseHandler::class);
        $message = new MessageStub(null);
        $handler->send($message);
    }
}

class MessageStub extends Message
{
    use Deletable;

    /**
     * Message to send object
     * @return array
     */
    public function toData()
    {
        // TODO: Implement toData() method.
    }
}
