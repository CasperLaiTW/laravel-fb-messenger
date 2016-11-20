<?php
use Casperlaitw\LaravelFbMessenger\Controllers\DebugController;
use Illuminate\Contracts\View\Factory;
use Mockery as m;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/20
 * Time: 下午3:48
 */
class DebugControllerTest extends TestCase
{
    public function test_index()
    {
        $factory = m::mock(Factory::class);
        $factory->shouldReceive('make')->once()->andReturnSelf();
        $controller = new DebugController();
        $controller->index($factory);
    }
}
