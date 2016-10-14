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
     * @var string
     */
    private $postback;

    /**
     * @var string
     */
    private $recipient;

    /**
     * @var array
     */
    private $attachments;

    /**
     * Receive constructor.
     *
     * @param string $message
     * @param string $postback
     * @param string $recipient
     * @param string $sender
     * @param bool $skip
     * @param bool $payload
     *
     * @internal param bool $isDelivery
     */
    public function __construct($message, $postback, $recipient, $sender, $skip = false, $payload = false, $attachments = false)
    {
        $this->message = $message;
        $this->postback = $postback;
        $this->recipient = $recipient;
        $this->sender = $sender;
        $this->skip = $skip;
        $this->payload = $payload;
        $this->attachments = $attachments;
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
     * Get postback payload
     * @return string
     */
    public function getPostback()
    {
        return $this->postback;
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

    /**
     * Get recipient id
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * Get attachements
     * @return array
     */
    public function getAttachments()
    {
        return $this->attachments;
    }
}
