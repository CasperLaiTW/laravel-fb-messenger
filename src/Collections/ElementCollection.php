<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午5:15
 */

namespace Casperlaitw\LaravelFbMessenger\Collections;

/**
 * Class ElementCollection
 * @package Casperlaitw\LaravelFbMessenger\Collections
 */
class ElementCollection extends BaseCollection
{
    /**
     * @param        $title
     * @param        $description
     * @param string $image
     * @param string $url
     *
     * @return Element
     */
    public function addElement($title, $description, $image = '', $url = '')
    {
        $element = new Element($title, $description, $image, $url);
        $this->elements[] = $element;

        return $element;
    }

    /**
     * @return array
     */
    public function getElements() : array
    {
        $elements = [];

        foreach ($this->elements as $element) {
            $elements[] = $element->toData();
        }

        return $elements;
    }
}
