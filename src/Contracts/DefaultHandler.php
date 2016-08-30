<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午1:45
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use pimax\Messages\Message;

/**
 * Class DefaultHandler
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
class DefaultHandler extends BaseHandler
{
    /**
     * Handle the chatbot message
     * @return mixed
     */
    public function handle()
    {
        $this->messages->each(function (ReceiveMessage $message) {
            $this->app->send(new Message($message->getSender(), "Default Handler: {$message->getMessage()}"));
        });
    }
}
