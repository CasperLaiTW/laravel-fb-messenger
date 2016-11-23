<?php

use Casperlaitw\LaravelFbMessenger\Contracts\Debug\Debug;
use Casperlaitw\LaravelFbMessenger\Middleware\RequestReceived;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Mockery as m;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/20
 * Time: 下午3:41
 */
class RequestReceivedTest extends TestCase
{
    public function test_handle()
    {
        $request = m::mock(Request::class);
        $request->shouldReceive('all')->andReturn([]);

        $dispatch = m::mock(Dispatcher::class);

        $debug = new Debug($dispatch);

        $received = new RequestReceived($debug);
        $received->handle($request, function () {
        });
    }
}
