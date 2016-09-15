<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午4:19
 */

namespace Casperlaitw\LaravelFbMessenger\Transformers;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Exceptions\RequiredArgumentException;
use pimax\Messages\StructuredMessage;

/**
 * Class ButtonTransformer
 * @package Casperlaitw\LaravelFbMessenger\Transformers
 */
class ButtonTransformer implements StructuredTransformer
{
    /**
     * Transform payload
     *
     * @param Message $message
     *
     * @return array
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\RequiredArgumentException
     */
    public function transform(Message $message)
    {
        if (empty($message->getText())) {
            throw new RequiredArgumentException('Text is required');
        }

        return [
            'template_type' => 'button',
            'text' => $message->getText(),
            'buttons' => $message->getCollections()->toData(),
        ];
    }
}
