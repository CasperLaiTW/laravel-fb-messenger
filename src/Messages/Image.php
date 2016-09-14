<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午3:28
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use pimax\Messages\ImageMessage;

/**
 * Class ImageMessage
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Image extends Message
{
    /**
     * Image path/url
     * @var string
     */
    private $image;

    /**
     * ImageMessage constructor.
     *
     * @param $sender
     * @param $image
     */
    public function __construct($sender, $image)
    {
        parent::__construct($sender);
        $this->image = $image;
    }

    /**
     * Message to send
     *
     * @return \pimax\Messages\Message
     */
    public function toData()
    {
        return new ImageMessage($this->getSender(), $this->image);
    }
}
