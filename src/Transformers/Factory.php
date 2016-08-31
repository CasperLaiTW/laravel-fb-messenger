<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午4:28
 */

namespace Casperlaitw\LaravelFbMessenger\Transformers;

use Casperlaitw\LaravelFbMessenger\Exceptions\UnknownTypeException;
use pimax\Messages\StructuredMessage;

/**
 * Class Factory
 * @package Casperlaitw\LaravelFbMessenger\Transformers
 */
class Factory
{
    /**
     * @param string $type
     *
     * @return ButtonStructuredMessage
     * @throws UnknownTypeException
     */
    public static function make(string $type)
    {
        switch ($type) {
            case StructuredMessage::TYPE_BUTTON:
                return new ButtonStructuredMessage;
            case StructuredMessage::TYPE_GENERIC:
                break;
            case StructuredMessage::TYPE_RECEIPT:
                break;
        }

        throw new UnknownTypeException();
    }
}
