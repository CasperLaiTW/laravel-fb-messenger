<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午3:41
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

/**
 * Class StructuredMessage
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
/**
 * Class Structured
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
abstract class Structured extends Message
{
    /**
     * @var array
     */
    private $elements;

    /**
     * Add elements
     * @param $elements
     *
     * @return $this
     */
    public function add($elements)
    {
        if (is_array($elements)) {
            foreach ($elements as $element) {
                $this->add($element);
            }
        } else {
            if ($this->validator($elements)) {
                $this->elements[] = $elements;
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param $elements
     *
     * @return mixed
     */
    abstract public function validator($elements);
}
