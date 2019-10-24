<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/20
 * Time: 上午3:33
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts\Debug;

use Carbon\Carbon;
use Casperlaitw\LaravelFbMessenger\Events\Broadcast;
use Illuminate\Events\Dispatcher;

/**
 * Class Debug
 * @package Casperlaitw\LaravelFbMessenger
 */
class Debug
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $response;

    /**
     * @var string
     */
    private $webhook;

    /**
     * @var string
     */
    private $request;

    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * @var integer
     */
    private $status;

    /**
     * Debug constructor.
     * @param Dispatcher $dispatcher
     */
    public function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param $webhook
     *
     * @return $this
     */
    public function setWebhook($webhook)
    {
        $this->webhook = $webhook;
        $this->id = Carbon::now()->toDateTimeString();

        return $this;
    }

    /**
     * @param $request
     *
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;

        return $this;
    }

    /**
     * @param $response
     *
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set error message.
     *
     * @param $error
     *
     * @return $this
     */
    public function setError($error)
    {
        $this->response = $error;
        $this->status = 500;

        return $this;
    }

    /**
     *
     */
    public function broadcast()
    {
        $this->dispatcher->dispatch(
            new Broadcast($this->id, $this->webhook, $this->request, $this->response, $this->status)
        );

        $this->webhook = $this->request = $this->response = $this->status = null;
    }

    /**
     * Clear all.
     */
    public function clear()
    {
        $this->webhook = $this->request = $this->response = $this->status = $this->id = null;
    }
}
