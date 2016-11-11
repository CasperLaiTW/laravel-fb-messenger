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
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $image;

    /**
     * @var string
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
    public function __construct($title, $description, $image = '', $url = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->url = $url;
        $this->buttons = new ButtonCollection;
    }

    /**
     * Get button collection
     *
     * @return ButtonCollection
     */
    public function buttons()
    {
        return $this->buttons;
    }

    /**
     * To array for send api
     *
     * @return array
     */
    public function toData()
    {
        $button = $this->buttons()->isEmpty() ? [] : ['buttons' => $this->buttons->toData()];
        return array_merge([
            'title' => $this->title,
            'subtitle' => $this->description,
            'item_url' => $this->url,
            'image_url' => $this->image,
        ], $button);
    }
}
