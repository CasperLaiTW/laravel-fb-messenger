<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午4:51
 */

namespace Casperlaitw\LaravelFbMessenger\Transformers;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Template;

/**
 * Class GenericTransformer
 * @package Casperlaitw\LaravelFbMessenger\Transformers
 */
class GenericTransformer implements StructuredTransformer
{
    /**
     * Transform payload
     *
     * @param Template $message
     *
     * @return array
     */
    public function transform(Template $message)
    {
        return [
            'template_type' => 'generic',
            'elements' => $message->getCollections()->toData()
        ];
    }
}
