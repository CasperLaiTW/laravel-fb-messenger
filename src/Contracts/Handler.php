<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午1:16
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

/**
 * Interface Receiver
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
interface Handler
{
    /**
     * Handle the chatbot message
     * @return mixed
     */
    public function handle();
}
