<?php
/**
 * User: casperlai
 * Date: 2016/9/14
 * Time: 下午11:39
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use pimax\Messages\Attachment;

/**
 * Class File
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class File extends Message
{
    /**
     * @var Attachment
     */
    private $file;

    /**
     * File constructor.
     *
     * @param $sender
     * @param $file
     */
    public function __construct($sender, $file)
    {
        parent::__construct($sender);
        $this->file = new Attachment(Attachment::TYPE_FILE, ['url' => $file]);
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
        ] + $this->file->getData();
    }
}
