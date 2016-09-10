<?php

use Casperlaitw\LaravelFbMessenger\Providers\RouteServiceProvider;
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

    public function setUp()
    {
        parent::setUp();
        $this->setUpMock();
        $this->serviceProvider = new RouteServiceProvider($this->applicationMock);
    }

    protected function setUpMock()
    {
        $this->applicationMock = m::mock(Application::class);
        $this->applicationMock
            ->shouldReceive('routesAreCached')
            ->andReturn(false);
        $this->router = m::mock(Router::class);
        $this->router
            ->shouldReceive('group')
            ->with(m::any(), m::type(Closure::class))
            ->andReturnUsing(function ($options, $closure) {
            });
    }

    public function test_boot()
    {
        $this->assertNull($this->serviceProvider->boot($this->router));
    }
}
