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
     * ElementCollection constructor.
     *
     * @param array $elements
     */
    public function __construct(array $elements = [])
    {
        foreach ($elements as $element) {
            $this->add($element);
        }
    }

    /**
     * Add element
     *
     * @param        $title
     * @param        $description
     * @param string $image
     *
     * @return Element
     * @internal param string $url
     *
     */
    public function addElement($title, $description, $image = '')
    {
        $element = new Element($title, $description, $image);
        $this->add($element);

        return $element;
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
                'The `generic` structure item should be instance of `Casperlaitw\LaravelFbMessenger\Messages\Element`'
            );
        }

        return true;
    }
}
