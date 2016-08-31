<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午4:51
 */

namespace Casperlaitw\LaravelFbMessenger\Transformers;

use Casperlaitw\LaravelFbMessenger\Messages\Message;
use pimax\Messages\StructuredMessage;

/**
 * Class GenericTransformer
 * @package Casperlaitw\LaravelFbMessenger\Transformers
 */
class GenericTransformer implements StructuredTransformer
{
    /**
     * Transform structure
     *
     * @param Message $message
     *
     * @return mixed
     */
    public function transform(Message $message)
    {
        return new StructuredMessage(
            $message->getSender(),
            StructuredMessage::TYPE_GENERIC,
            [
                'elements' => $message->getElements(),
            ]
        );
    }
}
