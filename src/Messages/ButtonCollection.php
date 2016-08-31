<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午4:59
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use pimax\Messages\MessageButton;

/**
 * Class ButtonCollection
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class ButtonCollection extends BaseCollection
{
    /**
     * @param $text
     *
     * @param $key
     *
     * @return ButtonCollection
     */
    public function addPostBackButton($text, $key = '') : ButtonCollection
    {
        $this->elements[] = new MessageButton(MessageButton::TYPE_POSTBACK, $text, $key);
        return $this;
    }

    /**
     * @param $text
     * @param $url
     *
     * @return ButtonCollection
     */
    public function addWebButton($text, $url) : ButtonCollection
    {
        $this->elements[] = new MessageButton(MessageButton::TYPE_WEB, $text, $url);
        return $this;
    }
}
