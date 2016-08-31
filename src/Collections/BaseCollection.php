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
abstract class BaseCollection
{
    /**
     * @var array
     */
    protected $elements = [];

    /**
     * @return array
     */
    public function getElements() : array
    {
        return $this->elements;
    }
}
