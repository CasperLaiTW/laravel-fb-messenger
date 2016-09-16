<?php
/**
 * User: casperlai
 * Date: 2016/9/16
 * Time: 上午11:05
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;

/**
 * Class Typing
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Typing extends Message
{
    /**
     * Typing on type
     */
    const TYPE_ON = 'typing_on';

    /**
     * Typing off type
     */
    const TYPE_OFF = 'typing_off';

    /**
     * Mark seen type
     */
    const TYPE_SEEN = 'mark_seen';

    /**
     * @var string
     */
    private $type;

    /**
     * Typing constructor.
     *
     * @param        $sender
     * @param string $type
     */
    public function __construct($sender, $type = self::TYPE_ON)
    {
        parent::__construct($sender);
        $this->type = $type;
    }


    /**
     * To array for send api
     * @return array
     */
    public function toData()
    {
        return [
            'recipient' => [
                'id' => $this->getSender(),
            ],
            'sender_action' => $this->type,
        ];
    }
}
