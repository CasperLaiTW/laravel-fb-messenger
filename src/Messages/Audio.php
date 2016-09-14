<?php
/**
 * User: casperlai
 * Date: 2016/9/14
 * Time: 下午10:42
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use pimax\Messages\Attachment;

/**
 * Class Audio
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Audio extends Message
{
    /**
     * @var Attachment
     */
    private $audio;

    /**
     * Audio constructor.
     *
     * @param $sender
     * @param $audio
     */
    public function __construct($sender, $audio)
    {
        parent::__construct($sender);
        $this->audio = new Attachment(Attachment::TYPE_AUDIO, ['url' => $audio]);
    }

    /**
     * Message to send object
     * @return array
     */
    public function toData()
    {
        return [
            'recipient' =>  [
                'id' => $this->getSender()
            ],
        ] + $this->audio->getData();
    }
}
