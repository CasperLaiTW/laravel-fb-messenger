<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午4:59
 */

namespace Casperlaitw\LaravelFbMessenger\Collections;

use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use pimax\Messages\MessageButton;

/**
 * Class ButtonCollection
 * @package Casperlaitw\LaravelFbMessenger\Collections
 */
class ButtonCollection extends BaseCollection
{
    /**
     * Add postback button
     *
     * @param $text
     * @param $key
     *
     * @return ButtonCollection
     */
    public function addPostBackButton($text, $key = '')
    {
        $this->elements[] = new MessageButton(MessageButton::TYPE_POSTBACK, $text, $key);
        return $this;
    }

    /**
     * Add web_url button
     *
     * @param $text
     * @param $url
     *
     * @return ButtonCollection
     */
    public function addWebButton($text, $url)
    {
        $this->elements[] = new MessageButton(MessageButton::TYPE_WEB, $text, $url);
        return $this;
    }

    /**
     * Valid the added element
     * @param $elements
     *
     * @return bool
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException
     */
    public function validator($elements)
    {
        if (!$elements instanceof MessageButton) {
            throw new ValidatorStructureException(
                'The `button` structure item should be instance of `\\pimax\\Messages\\MessageButton`'
            );
        }

        return true;
    }
}
