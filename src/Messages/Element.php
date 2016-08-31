<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午5:17
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Collections\ButtonCollection;
use pimax\Messages\MessageElement;

/**
 * Class Element
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Element
{
    /**
     * @var
     */
    private $title;

    /**
     * @var
     */
    private $description;

    /**
     * @var
     */
    private $image;

    /**
     * @var
     */
    private $url;

    /**
     * @var ButtonCollection
     */
    private $buttons;

    /**
     * Element constructor.
     *
     * @param $title
     * @param $description
     * @param $image
     * @param $url
     */
    public function __construct($title, $description, $image, $url)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->url = $url;
        $this->buttons = new ButtonCollection;
    }

    /**
     * @return ButtonCollection
     */
    public function buttons()
    {
        return $this->buttons;
    }

    /**
     * @return MessageElement
     */
    public function toData()
    {
        return new MessageElement(
            $this->title,
            $this->description,
            $this->image,
            $this->buttons->getElements(),
            $this->url
        );
    }
}
