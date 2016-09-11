<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午5:15
 */

namespace Casperlaitw\LaravelFbMessenger\Collections;

use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Messages\Element;

/**
 * Class ElementCollection
 * @package Casperlaitw\LaravelFbMessenger\Collections
 */
class ElementCollection extends BaseCollection
{
    /**
     * Add element
     *
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
        $this->add($element);

        return $element;
    }

    /**
     * Elements to array
     *
     * @return array
     */
    public function toArray()
    {
        $elements = [];

        foreach ($this->elements as $element) {
            $elements[] = $element->toData();
        }

        return $elements;
    }

    /**
     * Valid the added element
     *
     * @param $elements
     *
     * @return bool
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException
     */
    public function validator($elements)
    {
        if (!$elements instanceof Element) {
            throw new ValidatorStructureException(
                'The `generic` structure item should be instance of `\\pimax\\Messages\\MessageElement`'
            );
        }

        return true;
    }
}
