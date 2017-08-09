<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午5:17
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Collections\ButtonCollection;
use Casperlaitw\LaravelFbMessenger\Exceptions\DefaultActionInvalidTypeException;
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
     * Default action
     *
     * @var UrlButton
     */
    private $defaultAction;

    /**
     * Element constructor.
     *
     * @param        $title
     * @param        $description
     * @param string $image
     *
     * @internal param $url
     */
    public function __construct($title, $description, $image = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
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
     * Set default action button
     *
     * @param UrlButton $button
     * @return $this
     * @throws DefaultActionInvalidTypeException
     */
    public function setDefaultAction(UrlButton $button)
    {
        $this->defaultAction = $button;

        return $this;
    }

    /**
     * To array for send api
     *
     * @return array
     */
    public function toData()
    {
        $button = $this->buttons()->isEmpty() ? [] : ['buttons' => $this->buttons->toData()];

        $data = array_merge([
            'title' => $this->title,
            'subtitle' => $this->description,
            'image_url' => $this->image,
        ], $button);

        if ($this->defaultAction) {
            $defaultActionData = $this->defaultAction->toData();
            unset($defaultActionData['title']);
            $data['default_action'] = $defaultActionData;
        }

        return $data;
    }
}
