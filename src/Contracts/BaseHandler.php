<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午1:46
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Collections\ReceiveMessageCollection;
use Casperlaitw\LaravelFbMessenger\Messages\Deletable;
use Casperlaitw\LaravelFbMessenger\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Casperlaitw\LaravelFbMessenger\Messages\ThreadInterface;

/**
 * Class BaseHandler
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
abstract class BaseHandler implements Handler
{
    /**
     * @var ReceiveMessageCollection
     */
    protected $messages;

    /**
     * @var Bot
     */
    protected $bot;

    /**
     * Receiver constructor.
     */
    public function __construct()
    {
        $this->bot = new Bot(config('fb-messenger.app_token'));
    }

    /**
     * @param Message $message
     *
     * @return array
     */
    public function send(Message $message)
    {
        $arguments = [$message];
        if (in_array(Deletable::class, class_uses($message))) {
            $arguments[] = $message->getCurlType();
        }

        return call_user_func_array([$this->bot, 'send'], $arguments);
    }

    /**
     * @return ReceiveMessageCollection
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Handle the chatbot message
     *
     * @param ReceiveMessage $message
     *
     * @return mixed
     */
    abstract public function handle(ReceiveMessage $message);

    /**
     * @param ReceiveMessageCollection $messages
     *
     * @return BaseHandler
     */
    public function setMessages($messages)
    {
        $this->messages = $messages;

        return $this;
    }
}
