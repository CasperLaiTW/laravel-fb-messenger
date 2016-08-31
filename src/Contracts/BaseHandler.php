<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午1:46
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessageCollection;
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
        $this->messages = $messages->filterSkip();
        $this->app = new FbBotApp(config('fb-messenger.app_token'));
    }

    /**
     * Handle the chatbot message
     * @return mixed
     */
    abstract public function handle();
}
