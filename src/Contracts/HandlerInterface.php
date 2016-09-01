<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午1:16
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;

/**
 * Interface Receiver
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
interface HandlerInterface
{
    /**
     * Handle the chatbot message
     *
     * @param ReceiveMessage $message
     *
     * @return mixed
     */
    public function handle(ReceiveMessage $message);
}
