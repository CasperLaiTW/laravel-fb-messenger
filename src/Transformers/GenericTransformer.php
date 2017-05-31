<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午4:51
 */

namespace Casperlaitw\LaravelFbMessenger\Transformers;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Template;
use Casperlaitw\LaravelFbMessenger\Messages\GenericTemplate;

/**
 * Class GenericTransformer
 * @package Casperlaitw\LaravelFbMessenger\Transformers
 */
class GenericTransformer implements StructuredTransformer
{
    /**
     * Transform payload
     *
     * @param Template|GenericTemplate $message
     *
     * @return array
     */
    public function transform(Template $message)
    {
        return [
            'template_type' => 'generic',
            'image_aspect_ratio' => $message->getImageRatio(),
            'elements' => $message->getCollections()->toData()
        ];
    }
}
