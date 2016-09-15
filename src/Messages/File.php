<?php
/**
 * User: casperlai
 * Date: 2016/9/14
 * Time: 下午11:39
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Attachment;

/**
 * Class File
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class File extends Attachment
{
    /**
     * File constructor.
     *
     * @param $sender
     * @param $file
     */
    public function __construct($sender, $file)
    {
        parent::__construct($sender, self::TYPE_FILE, ['url' => $file]);
    }
}
