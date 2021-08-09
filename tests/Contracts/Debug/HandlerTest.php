<?php

use Casperlaitw\LaravelFbMessenger\Contracts\Debug\Handler;
use Casperlaitw\LaravelFbMessenger\Contracts\Debug\Debug;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Arr;
use Mockery as m;
use Symfony\Component\HttpFoundation\Response;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/23
 * Time: 下午2:02
 */
class HandlerTest extends TestCase
{
    private $exceptionHandler;
    private $debug;
    private $handler;

    public function setUp()
    {
        parent::setUp();

        $this->exceptionHandler = m::mock(ExceptionHandler::class);

        $dispatcher = m::mock(Dispatcher::class);
        $this->debug = m::mock(Debug::class.'[broadcast]', [$dispatcher]);
        $this->debug->shouldReceive('broadcast');

        $this->handler = new Handler($this->exceptionHandler, $this->debug);
    }

    public function test_report()
    {
        $this->exceptionHandler->shouldReceive('report')->once();
        $this->handler->report(m::mock(Exception::class));
    }

    public function test_renderForConsole()
    {
        $this->exceptionHandler->shouldReceive('renderForConsole')->once();
        $this->handler->renderForConsole('', m::mock(Exception::class));
    }

    public function test_render()
    {
        $response = m::mock(Response::class);
        $this->exceptionHandler
            ->shouldReceive('render')
            ->andReturn($response);

        $exception = new Exception('ERROR');
        $this->handler->render(null, $exception);

        $actual = $this->getPrivateProperty(Handler::class, 'debug')->getValue($this->handler);
        $this->assertEquals(500, $actual->getStatus());
        $this->assertEquals('ERROR', Arr::get($actual->getResponse(), 'message'));
    }
}
