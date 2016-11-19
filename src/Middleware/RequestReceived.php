<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/20
 * Time: 上午2:07
 */

namespace Casperlaitw\LaravelFbMessenger\Middleware;

use Casperlaitw\LaravelFbMessenger\Events\RequestReceived as RequestReceivedEvent;
use Illuminate\Events\Dispatcher;

/**
 * Class RequestReceived
 * @package Casperlaitw\LaravelFbMessenger\Middleware
 */
class RequestReceived
{
    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * RequestReceived constructor.
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param $request
     * @param $next
     *
     * @return mixed
     */
    public function handle($request , $next)
    {
        $this->dispatcher->fire(new RequestReceivedEvent($request->all()));

        return $next($request);
    }
}