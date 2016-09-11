<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午2:21
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Collections\ReceiveMessageCollection;
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
    private $messaging = [];

    /**
     * @var ReceiveMessageCollection
     */
    private $collection;

    /**
     * @var bool
     */
    private $filterSkip;

    /**
     * Receiver constructor.
     *
     * @param Request $request
     * @param bool    $filterSkip
     */
    public function __construct(Request $request, $filterSkip = true)
    {
        $this->messaging = $request->input('entry.0.messaging');
        $this->filterSkip = $filterSkip;
        $this->boot();
    }

    /**
     * Boot to reorganize messages
     */
    private function boot()
    {
        $messages = [];
        foreach ($this->messaging as $message) {
            // is payload
            if (Arr::has($message, 'postback.payload')) {
                $messages[] = new ReceiveMessage(
                    Arr::get($message, 'postback.payload'),
                    Arr::get($message, 'sender.id'),
                    false,
                    true
                );
                continue;
            }

            $messages[] = new ReceiveMessage(
                Arr::get($message, 'message.text'),
                Arr::get($message, 'sender.id'),
                Arr::has($message, 'delivery') ||
                Arr::has($message, 'message.is_echo') ||
                !Arr::has($message, 'message.text')
            );
        }
        $this->collection = new ReceiveMessageCollection($messages);

        if ($this->filterSkip) {
            $this->collection = $this->collection->filterSkip();
        }
    }

    /**
     * Get message collection
     *
     * @return ReceiveMessageCollection
     */
    public function getMessages()
    {
        return $this->collection;
    }
}
