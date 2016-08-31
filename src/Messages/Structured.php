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
use Casperlaitw\LaravelFbMessenger\Collections\BaseCollection;

/**
 * Class Structured
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
abstract class Structured extends Message
{
    /**
     * @var BaseCollection
     */
    protected $collections;

    /**
     * Structured constructor.
     *
     * @param $sender
     */
    public function __construct($sender)
    {
        parent::__construct($sender);
        $this->collections = app($this->collection());
    }


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
            $this->collections->add($elements);
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
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        } elseif (method_exists($this->collections, $name)) {
            return call_user_func_array([$this->collections, $name], $arguments);
        }
    }

    /**
     * @return BaseCollection
     */
    public function getCollections() : BaseCollection
    {
        return $this->collections;
    }

    /**
     * @return mixed
     */
    abstract protected function collection();
}
