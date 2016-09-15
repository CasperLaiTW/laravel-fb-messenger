<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午3:28
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Attachment;

/**
 * Class ImageMessage
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Image extends Attachment
{
    /**
     * ImageMessage constructor.
     *
     * @param $sender
     * @param $image
     */
    public function __construct($sender, $image)
    {
        parent::__construct($sender, self::TYPE_IMAGE, ['url' => $image]);
    }
}
