<?php

use ArrayAccess as Application;
use Casperlaitw\LaravelFbMessenger\Providers\RouteServiceProvider;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Routing\Router;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/11
 * Time: 上午12:55
 */
class RouteServiceProviderTest extends TestCase
{
    private $applicationMock;

    private $serviceProvider;

    private $router;

    private $configMock;

    public function setUp()
    {
        parent::setUp();
        $this->setUpMock();
        $this->serviceProvider = new RouteServiceProvider($this->applicationMock);
    }

    protected function setUpMock()
    {
        $this->configMock = m::mock(Config::class);
        $this->configMock
            ->shouldReceive('get')
            ->andReturn([]);
        $this->applicationMock = m::mock(Application::class);
        $this->applicationMock
            ->shouldReceive('routesAreCached')
            ->andReturn(false)
            ->shouldReceive('offsetGet')
            ->zeroOrMoreTimes()
            ->with('config')
            ->andReturn($this->configMock);
        $this->router = m::mock(Router::class);
        $this->router
            ->shouldReceive('group')
            ->with(m::any(), m::type(Closure::class))
            ->andReturnUsing(function ($options, $closure) {
                $closure($this->router);
            })
            ->shouldReceive('get')
            ->andReturnNull()
            ->shouldReceive('post')
            ->andReturnNull();
    }

    public function test_boot()
    {
        $this->assertNull($this->serviceProvider->boot($this->router));
    }

    public function test_register()
    {
        $this->assertNull($this->serviceProvider->register());
    }
}
