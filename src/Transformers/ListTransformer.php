<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/9
 * Time: 上午9:16
 */

namespace Casperlaitw\LaravelFbMessenger\Transformers;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;

/**
 * Class ListTransformer
 * @package Casperlaitw\LaravelFbMessenger\Transformers
 */
class ListTransformer implements StructuredTransformer
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
        return array_merge([
            'template_type' => 'list',
            'top_element_style' => $message->getTopStyle(),
            'elements' => $message->getCollections()->toData(),
        ], $message->getButton() !== null ? ['buttons' => [$message->getButton()->toData()]] : []);
    }
}
