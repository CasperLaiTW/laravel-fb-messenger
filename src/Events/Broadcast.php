<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/20
 * Time: 上午3:37
 */

namespace Casperlaitw\LaravelFbMessenger\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class Broadcast implements ShouldBroadcast
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
     * @var
     */
    private $webhook;
    /**
     * @var
     */
    private $id;

    /**
     * RequestReceived constructor.
     * @param $id
     * @param $webhook
     * @param $request
     * @param $response
     * @param $status
     */
    public function __construct($id, $webhook, $request, $response, $status)
    {
        $this->request = $request;
        $this->response = $response;
        $this->status = $status;
        $this->webhook = $webhook;
        $this->id = $id;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'id' => $this->id,
            'webhook' => $this->webhook,
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
