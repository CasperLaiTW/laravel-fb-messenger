<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午2:38
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

/**
 * Class TextMessage
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Text extends Message
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
     * Message to send object
     *
     * @return \pimax\Messages\Message
     */
    public function toData()
    {
        return new \pimax\Messages\Message($this->getSender(), $this->message);
    }
}
