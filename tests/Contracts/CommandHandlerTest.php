<?php

use Casperlaitw\LaravelFbMessenger\Contracts\CommandHandler;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/8
 * Time: 下午9:43
 */
class CommandHandlerTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function test_handle_throw_exception()
    {
        $this->expectException(Exception::class);
        $command = new CommandHandler();
        $command->handle(m::mock(ReceiveMessage::class)->makePartial());
    }
}
