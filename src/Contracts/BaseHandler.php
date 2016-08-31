<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午1:46
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Collections\ReceiveMessageCollection;
use Casperlaitw\LaravelFbMessenger\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;

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
     */
    public function send(Message $message)
    {
        $this->bot->send($message->toData());
    }

    /**
     * @param Message $message
     */
    public function sendThreadSetting(Message $message)
    {
        $this->bot->sendThreadSetting($message);
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
}
