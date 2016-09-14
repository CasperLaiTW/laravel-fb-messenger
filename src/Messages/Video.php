<?php
/**
 * User: casperlai
 * Date: 2016/9/14
 * Time: 下午11:37
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use pimax\Messages\Attachment;

/**
 * Class Video
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Video extends Message
{
    /**
     * @var Attachment
     */
    private $video;

    /**
     * Video constructor.
     *
     * @param $sender
     * @param $video
     */
    public function __construct($sender, $video)
    {
        parent::__construct($sender);
        $this->video = new Attachment(Attachment::TYPE_VIDEO, ['url' => $video]);
    }


    /**
     * Message to send
     * @return array
     */
    public function toData()
    {
        return [
            'recipient' =>  [
                'id' => $this->getSender()
            ],
        ] + $this->video->getData();
    }
}
