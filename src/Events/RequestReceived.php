<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/19
 * Time: 下午11:50
 */

namespace Casperlaitw\LaravelFbMessenger\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class RequestReceived implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * @var array
     */
    private $request;

    /**
     * RequestReceived constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
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