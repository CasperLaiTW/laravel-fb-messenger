<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午1:08
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

/**
 * Class ReceiveMessage
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class ReceiveMessage
{

    /**
     * @var string
     */
    protected $sender;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var bool
     */
    protected $skip;

    /**
     * Receive constructor.
     *
     * @param      $message
     * @param      $sender
     * @param bool $skip
     *
     * @internal param bool $isDelivery
     */
    public function __construct($message, $sender, $skip = false)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->skip = $skip;
    }

    /**
     * @return bool
     */
    public function isSkip()
    {
        return $this->skip;
    }

    /**
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}
