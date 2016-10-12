<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午2:38
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;

/**
 * Class TextMessage
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Text extends Message
{
    use Quickable;

    /**
     * @var
     */
    private $message;

    /**
     * TextMessage constructor.
     *
     * @param $sender
     * @param $message
     */
    public function __construct($sender, $message)
    {
        parent::__construct($sender);
        $this->message = $message;
        $this->bootQuick();
    }

    /**
     * To array for send api
     *
     * @return array
     */
    public function toData()
    {
        return $this->makeQuickReply([
            'recipient' =>  [
                'id' => $this->getSender(),
            ],
            'message' => [
                'text' => $this->message,
            ],
        ]);
    }
}
