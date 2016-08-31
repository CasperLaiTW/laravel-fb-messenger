<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午2:20
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Illuminate\Support\Collection;

/**
 * Class ReceiveMessageCollection
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class ReceiveMessageCollection extends Collection
{
    /**
     * Filter messages
     * @return ReceiveMessageCollection
     */
    public function filterSkip() : ReceiveMessageCollection
    {
        return $this->filter(function (ReceiveMessage $message) {
            return !$message->isSkip();
        });
    }
}
