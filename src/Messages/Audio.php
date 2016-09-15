<?php
/**
 * User: casperlai
 * Date: 2016/9/14
 * Time: 下午10:42
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Attachment;

/**
 * Class Audio
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Audio extends Attachment
{
    /**
     * Audio constructor.
     *
     * @param $sender
     * @param $audio
     */
    public function __construct($sender, $audio)
    {
        parent::__construct($sender, self::TYPE_AUDIO, ['url' => $audio]);
    }
}
