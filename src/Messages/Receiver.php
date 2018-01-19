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
        $this->messaging = $request->input('entry.0.messaging') ? $request->input('entry.0.messaging') : [];
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
            $receiveMessage = new ReceiveMessage(Arr::get($message, 'recipient.id'), Arr::get($message, 'sender.id'));
            // is payload
            if (Arr::has($message, 'postback.payload') || Arr::has($message, 'message.quick_reply.payload')) {
                $receiveMessage
                    ->setMessage(Arr::get($message, 'message.text'))
                    ->setReferral(Arr::get($message, 'postback.referral', []))
                    ->setPostback(Arr::get(
                        $message,
                        'postback.payload',
                        Arr::get(
                            $message,
                            'message.quick_reply.payload'
                        )
                    ))
                    ->setPayload(true);
            } else {
                $receiveMessage
                    ->setMessage(Arr::get($message, 'message.text'))
                    ->setReferral(Arr::get($message, 'referral', []))
                    ->setSkip(
                        Arr::has($message, 'delivery') ||
                        Arr::has($message, 'message.is_echo') ||
                        (!Arr::has($message, 'message.text') && !Arr::has($message, 'message.attachments') && !Arr::has($message, 'referral'))
                    )
                    ->setAttachments(Arr::get($message, 'message.attachments', []))
                    ->setNlp(Arr::get($message, 'message.nlp', []));
            }

            $messages[] = $receiveMessage;
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
