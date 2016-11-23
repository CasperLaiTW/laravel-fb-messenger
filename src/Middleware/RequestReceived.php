<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/20
 * Time: 上午2:07
 */

namespace Casperlaitw\LaravelFbMessenger\Middleware;

use Casperlaitw\LaravelFbMessenger\Contracts\Debug\Debug;

/**
 * Class RequestReceived
 * @package Casperlaitw\LaravelFbMessenger\Middleware
 */
class RequestReceived
{
    /**
     * @var
     */
    private $debug;

    /**
     * RequestReceived constructor.
     * @param Debug $debug
     */
    public function __construct(Debug $debug)
    {
        $this->debug = $debug;
    }

    /**
     * @param $request
     * @param $next
     *
     * @return mixed
     */
    public function handle($request, $next)
    {
        $this->debug->setWebhook($request->all());

        return $next($request);
    }
}
