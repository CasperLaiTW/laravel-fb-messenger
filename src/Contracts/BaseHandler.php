<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午1:46
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Exceptions\NotCreateBotException;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;

/**
 * Class BaseHandler
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
abstract class BaseHandler implements HandlerInterface
{
    /**
     * @var Bot
     */
    protected $bot;

    /**
     * Create bot to send API
     *
     * @param $token
     * @param $secret
     *
     * @return $this
     */
    public function createBot($token, $secret = null)
    {
        $this->bot = new Bot($token);
        $this->bot->setSecret($secret);

        return $this;
    }

    /**
     * @param $debug
     * @return $this
     */
    public function debug($debug)
    {
        $this->bot->setDebug($debug);

        return $this;
    }

    /**
     * Send message to api
     *
     * @param Message $message
     *
     * @return HandleMessageResponse
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\NotCreateBotException
     */
    public function send(Message $message)
    {
        if ($this->bot === null) {
            throw new NotCreateBotException;
        }
        $arguments = [$message];
        if (in_array(RequestType::class, class_uses($message))) {
            $arguments[] = $message->getCurlType();
        }

        return call_user_func_array([$this->bot, 'send'], $arguments);
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
