<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/20
 * Time: 上午1:45
 */

namespace Casperlaitw\LaravelFbMessenger\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class SendRequest implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var array
     */
    private $request;
    /**
     * @var
     */
    private $response;

    private $status;

    /**
     * RequestReceived constructor.
     * @param $request
     * @param $response
     * @param $status
     */
    public function __construct($request, $response, $status)
    {
        $this->request = $request;
        $this->response = $response;
        $this->status = $status;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'request' => $this->request,
            'response' => $this->response,
            'status' => $this->status,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['laravel-fb-messenger'];
    }
}