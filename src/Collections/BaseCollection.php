<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午5:15
 */

namespace Casperlaitw\LaravelFbMessenger\Collections;

/**
 * Class BaseCollection
 * @package Casperlaitw\LaravelFbMessenger\Collections
 */
/**
 * Class BaseCollection
 * @package Casperlaitw\LaravelFbMessenger\Collections
 */
abstract class BaseCollection
{
    /**
     * @var array
     */
    protected $elements = [];

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param $element
     */
    public function add($element)
    {
        if ($this->validator($element)) {
            $this->elements[] = $element;
        }
    }

    /**
     * @param $element
     *
     * @return bool
     */
    abstract public function validator($element);
}
