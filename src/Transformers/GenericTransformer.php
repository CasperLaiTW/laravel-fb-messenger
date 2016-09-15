<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午4:51
 */

namespace Casperlaitw\LaravelFbMessenger\Transformers;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use pimax\Messages\StructuredMessage;

/**
 * Class GenericTransformer
 * @package Casperlaitw\LaravelFbMessenger\Transformers
 */
class GenericTransformer implements StructuredTransformer
{
    /**
     * Transform payload
     *
     * @param Message $message
     *
     * @return array
     */
    public function transform(Message $message)
    {
        return [
            'template_type' => 'generic',
            'elements' => $message->getCollections()->toData()
        ];
    }
}
