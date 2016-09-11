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
    private $sender;

    /**
     * @var string
     */
    private $message;

    /**
     * @var bool
     */
    private $skip;

    /**
     * @var bool
     */
    private $payload;

    /**
     * Receive constructor.
     *
     * @param      $message
     * @param      $sender
     * @param bool $skip
     * @param bool $payload
     *
     * @internal param bool $isDelivery
     */
    public function __construct($message, $sender, $skip = false, $payload = false)
    {
        $this->message = $message;
        $this->sender = $sender;
        $this->skip = $skip;
        $this->payload = $payload;
    }

    /**
     * Is skip the message
     *
     * @return bool
     */
    public function isSkip()
    {
        return $this->skip;
    }

    /**
     * Get sender
     *
     * @return string
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Is playload message
     *
     * @return boolean
     */
    public function isPayload()
    {
        return $this->payload;
    }
}
