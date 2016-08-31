<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午2:38
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use pimax\Messages\Message as ApiMessage;

/**
 * Class TextMessage
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class TextMessage extends Message
{
    /**
     * @var
     */
    private $message;

    /**
     * TextMessage constructor.
     *
     * @param $sender
     * @param $message
     */
    public function __construct($sender, $message)
    {
        parent::__construct($sender);
        $this->message = $message;
    }

    /**
     * @return \pimax\Messages\Message
     */
    public function toData()
    {
        return new ApiMessage($this->getSender(), $this->message);
    }
}