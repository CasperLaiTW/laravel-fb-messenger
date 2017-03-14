<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午4:59
 */

namespace Casperlaitw\LaravelFbMessenger\Collections;

use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Messages\Button;

/**
 * Class ButtonCollection
 * @package Casperlaitw\LaravelFbMessenger\Collections
 */
class ButtonCollection extends BaseCollection
{
    /**
     * ButtonCollection constructor.
     *
     * @param array $buttons
     */
    public function __construct(array $buttons = [])
    {
        foreach ($buttons as $button) {
            $this->add($button);
        }
    }

    /**
     * Add postback button
     *
     * @param $text
     * @param $payload
     *
     * @return ButtonCollection
     */
    public function addPostBackButton($text, $payload = '')
    {
        $this->add(new Button(Button::TYPE_POSTBACK, $text, $payload));

        return $this;
    }

    /**
     * Add web url button
     *
     * @param $text
     * @param $url
     *
     * @return ButtonCollection
     */
    public function addWebButton($text, $url)
    {
        $this->add(new Button(Button::TYPE_WEB, $text, $url));

        return $this;
    }

    /**
     * Add account link button
     *
     * @param $url
     *
     * @return $this
     */
    public function addAccountLinkButton($url)
    {
        $this->add(new Button(Button::TYPE_ACCOUNT_LINK, null, $url));

        return $this;
    }

    /**
     * Add phone call button
     *
     * @param $title
     * @param $phone
     *
     * @return $this
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\OnlyUseByItselfException
     */
    public function addCallButton($title, $phone)
    {
        $this->add(new Button(Button::TYPE_CALL, $title, $phone));

        return $this;
    }

    /**
     * Add share button
     *
     * @return $this
     */
    public function addShareButton()
    {
        $this->add(new Button(Button::TYPE_SHARE, ''));

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
        if (!$elements instanceof Button) {
            throw new ValidatorStructureException(
                'The `button` object should be instance of `\Casperlaitw\LaravelFbMessenger\Messages\Button`'
            );
        }

        return true;
    }
}
