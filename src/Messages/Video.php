<?php
/**
 * User: casperlai
 * Date: 2016/9/14
 * Time: 下午11:37
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Attachment;

/**
 * Class Video
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Video extends Attachment
{
    /**
     * Video constructor.
     *
     * @param $sender
     * @param $video
     */
    public function __construct($sender, $video)
    {
        parent::__construct($sender, self::TYPE_VIDEO, ['url' => $video]);
    }
}
