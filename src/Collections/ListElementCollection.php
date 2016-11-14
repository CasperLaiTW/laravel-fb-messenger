<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/9
 * Time: 上午9:43
 */

namespace Casperlaitw\LaravelFbMessenger\Collections;

use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Messages\Element;
use Casperlaitw\LaravelFbMessenger\Messages\ListElement;

class ListElementCollection extends BaseCollection
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
     */
    public function addElement($title, $description, $image = '')
    {
        $element = new ListElement($title, $description, $image);
        $this->add($element);

        return $element;
    }

    /**
     * Validate collection item
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
                'The `list` structure item should be instance of `Casperlaitw\LaravelFbMessenger\Messages\ListElement`'
            );
        }

        return true;
    }
}
