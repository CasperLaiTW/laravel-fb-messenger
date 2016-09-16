<?php
/**
 * User: casperlai
 * Date: 2016/9/16
 * Time: 上午11:04
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Casperlaitw\LaravelFbMessenger\Messages\Typing;

/**
 * Class AutoTypingHandler
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
class AutoTypingHandler extends BaseHandler
{
    /**
     * Handle the chatbot message
     *
     * @param ReceiveMessage $message
     *
     * @return mixed
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\NotCreateBotException
     */
    public function handle(ReceiveMessage $message)
    {
        $typing = new Typing($message->getSender());
        $this->send($typing);
    }
}
