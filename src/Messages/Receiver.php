<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午2:21
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Class Receiver
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Receiver
{
    /**
     * @var array|string
     */
    protected $messaging = [];

    /**
     * @var ReceiveMessageCollection
     */
    protected $collection;

    /**
     * Receiver constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->messaging = $request->input('entry.0.messaging');
        $this->boot();
    }

    /**
     *
     */
    private function boot()
    {
        $messages = [];
        foreach ($this->messaging as $message) {
            $messages[] = new ReceiveMessage(
                Arr::get($message, 'message.text'),
                Arr::get($message, 'sender.id'),
                Arr::has($message, 'delivery') || Arr::has($message, 'message.is_echo')
            );
        }
        $this->collection = new ReceiveMessageCollection($messages);
    }

    /**
     * @return ReceiveMessageCollection
     */
    public function getMessages() : ReceiveMessageCollection
    {
        return $this->collection;
    }
}
