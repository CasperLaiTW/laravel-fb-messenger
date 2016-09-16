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
     * @var string
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
     * Get sender id
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * To array for send api
     * @return array
     */
    abstract public function toData();
}
