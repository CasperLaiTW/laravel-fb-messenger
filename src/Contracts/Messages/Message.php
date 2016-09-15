<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午2:41
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts\Messages;

/**
 * Class Message
 * @package Casperlaitw\LaravelFbMessenger\Contracts\Messages
 */
abstract class Message implements MessageInterface
{
    /**
     * @var
     */
    private $sender;

    /**
     * Message constructor.
     *
     * @param $sender
     */
    public function __construct($sender)
    {
        $this->sender = $sender;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * Message to send
     * @return \pimax\Messages\Message|array
     */
    abstract public function toData();
}
