<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午4:21
 */

namespace Casperlaitw\LaravelFbMessenger\Transformers;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;

/**
 * Interface StructuredTransformer
 * @package Casperlaitw\LaravelFbMessenger\Transformers
 */
interface StructuredTransformer
{
    /**
     * Transform payload
     *
     * @param Message $message
     *
     * @return array
     */
    public function transform(Message $message);
}
