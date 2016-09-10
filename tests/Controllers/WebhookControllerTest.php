<?php

use Casperlaitw\LaravelFbMessenger\Controllers\WebhookController;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Mockery as m;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * User: casperlai
 * Date: 2016/9/10
 * Time: 下午3:27
 */
class WebhookControllerTest extends PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        m::close();
    }

    public function test_index_token_verify_pass_response_challenge_token()
    {
        $verifyToken = 'MY_VERIFY_TOKEN';
        $challenge = str_random();
        $request = m::mock(Request::class)
            ->shouldReceive('get')
            ->with('hub_mode')
            ->andReturn('subscribe')
            ->shouldReceive('get')
            ->with('hub_verify_token')
            ->andReturn($verifyToken)
            ->shouldReceive('get')
            ->with('hub_challenge')
            ->andReturn($challenge)
            ->getMock();

        $config = m::mock(Repository::class)
            ->shouldReceive('get')
            ->andReturn($verifyToken)
            ->getMock();

        $controller = new WebhookController($config);
        $response = $controller->index($request);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals($challenge, $response->getContent());
    }

    public function test_index_and_abort()
    {
        $this->expectException(NotFoundHttpException::class);
        $request = m::mock(Request::class)
            ->shouldReceive('get')
            ->andReturn('')
            ->getMock();
        $config = m::mock(Repository::class)
            ->shouldReceive('get')
            ->andReturn(str_random())
            ->getMock();

        $controller = new WebhookController($config);
        $controller->index($request);
    }
}
