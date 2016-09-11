<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午2:20
 */

namespace Casperlaitw\LaravelFbMessenger\Collections;

use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Illuminate\Support\Collection;

/**
 * Class ReceiveMessageCollection
 * @package Casperlaitw\LaravelFbMessenger\Collections
 */
class ReceiveMessageCollection extends Collection
{
    /**
     * Filter messages
     *
     * @return ReceiveMessageCollection
     */
    public function filterSkip()
    {
        return $this->filter(function (ReceiveMessage $message) {
            return !$message->isSkip();
        });
    }
}
