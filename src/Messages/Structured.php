<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午3:41
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Exceptions\UnknownTypeException;
use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Transformers\Factory;
use Illuminate\Support\Arr;
use pimax\Messages\MessageButton;
use pimax\Messages\MessageElement;
use pimax\Messages\StructuredMessage;

/**
 * Class StructuredMessage
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
     * @param $elements
     *
     * @return mixed
     */
    abstract public function validator($elements);
}
