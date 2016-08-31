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
use pimax\FbBotApp;

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
     * @var FbBotApp
     */
    protected $app;

    /**
     * Receiver constructor.
     *
     * @param ReceiveMessageCollection $messages
     *
     */
    public function __construct(ReceiveMessageCollection $messages)
    {
        $this->messages = $messages;
        $this->app = new FbBotApp(config('fb-messenger.app_token'));
    }

    /**
     * @param Message $message
     */
    public function send(Message $message)
    {
        $this->app->send($message->toData());
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
