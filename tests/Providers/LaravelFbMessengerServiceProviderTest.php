<?php

use ArrayAccess as Application;
use Casperlaitw\LaravelFbMessenger\LaravelFbMessengerServiceProvider;
use Casperlaitw\LaravelFbMessenger\Providers\RouteServiceProvider;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Contracts\Events\Dispatcher as Events;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\View\Factory as View;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/11
 * Time: 上午12:06
 */
class LaravelFbMessengerServiceProviderTest extends TestCase
{
    private $applicationMock;

    private $eventsMock;

    private $serviceProvider;

    private $configMock;

    private $viewMock;

    public function setUp()
    {
        parent::setUp();
        $this->setUpMock();
        $this->serviceProvider = m::mock(LaravelFbMessengerServiceProvider::class.'[mergeConfigFrom]', [$this->applicationMock]);
        $this->serviceProvider
            ->shouldAllowMockingProtectedMethods()
            ->shouldReceive('mergeConfigFrom')
            ->andReturn(true);
    }

    protected function setUpMock()
    {
        $this->eventsMock = m::mock(Events::class);
        $this->eventsMock
            ->shouldReceive('listen')
            ->withAnyArgs()
            ->andReturnNull();

        $this->configMock = m::mock(Config::class);
        $this->configMock
            ->shouldReceive('get')
            ->with('fb-messenger', [])
            ->andReturn([])
            ->shouldReceive('set')
            ->andReturn(true)
            ->shouldReceive('get')
            ->with('fb-messenger.debug')
            ->andReturn(true);

        $this->viewMock = m::mock(View::class);
        $this->viewMock
            ->shouldReceive('addNamespace');

        $this->applicationMock = m::mock(Application::class);
        $this->applicationMock
            ->shouldReceive('configPath')
            ->andReturn(__DIR__)
            ->shouldReceive('resourcePath')
            ->andReturn(__DIR__)
            ->shouldReceive('basePath')
            ->andReturn(__DIR__)
            ->shouldReceive('offsetGet')
            ->zeroOrMoreTimes()
            ->with('events')
            ->andReturn($this->eventsMock)
            ->shouldReceive('offsetGet')
            ->zeroOrMoreTimes()
            ->with('config')
            ->andReturn($this->configMock)
            ->shouldReceive('offsetGet')
            ->zeroOrMoreTimes()
            ->with('view')
            ->andReturn($this->viewMock)
            ->shouldReceive('singleton')
            ->andReturnNull();
    }

    public function test_can_be_constructed()
    {
        $this->assertInstanceOf(LaravelFbMessengerServiceProvider::class, $this->serviceProvider);
    }

    public function test_register_the_router()
    {
        $this->applicationMock
            ->shouldReceive('register')
            ->with(RouteServiceProvider::class)
            ->andReturnNull();

        $this->assertNull($this->serviceProvider->register());
    }

    public function test_boot()
    {
        $this->assertNull($this->serviceProvider->boot());
    }
}
