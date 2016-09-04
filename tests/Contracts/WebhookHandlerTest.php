<?php

use Casperlaitw\LaravelFbMessenger\Contracts\BaseHandler;
use Casperlaitw\LaravelFbMessenger\Contracts\PostbackHandler;
use Casperlaitw\LaravelFbMessenger\Contracts\WebhookHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/4
 * Time: 下午3:24
 */
class WebhookHandlerTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function test_postback()
    {
        $handler = m::mock(BaseHandler::class)->makePartial();
        $webhook = new WebhookHandler($handler, null, [PostbackHandlerStub::class]);
        $actual = $this->getPrivateProperty(WebhookHandler::class, 'postbacks')->getValue($webhook);

        $this->assertArrayHasKey('MY_TEST_PAYLOAD', $actual);
        $this->assertEquals('MY_TEST_PAYLOAD', $actual['MY_TEST_PAYLOAD']->getPayload());
    }

    public function test_postback_handler_and_run()
    {
        $message = m::mock(ReceiveMessage::class)
            ->shouldReceive('isPayload')
            ->andReturn(true)
            ->shouldReceive('getMessage')
            ->andReturn('MY_TEST_PAYLOAD')
            ->getMock();
        $handler = m::mock(BaseHandler::class.'[getMessages]')
            ->shouldReceive('getMessages')
            ->andReturn(collect([$message]))
            ->getMock();

        $webhook = new WebhookHandler($handler, null, [PostbackHandlerStub::class]);
        $webhook->handle();
    }

    public function test_base_handler_and_run()
    {
        $message = m::mock(ReceiveMessage::class)
            ->shouldReceive('isPayload')
            ->andReturn(false)
            ->getMock();

        $handler = m::mock(BaseHandler::class.'[getMessages,handle]')
            ->shouldReceive('getMessages')
            ->andReturn(collect([$message]))
            ->shouldReceive('handle')
            ->andReturn(null)
            ->getMock();

        $webhook = new WebhookHandler($handler, null, [PostbackHandlerStub::class]);
        $webhook->handle();
    }
}

class PostbackHandlerStub extends PostbackHandler
{
    protected $payload = 'MY_TEST_PAYLOAD';

    /**
     * Handle the chatbot message
     *
     * @param ReceiveMessage $message
     *
     * @return mixed
     */
    public function handle(ReceiveMessage $message)
    {
        // TODO: Implement handle() method.
    }
}
