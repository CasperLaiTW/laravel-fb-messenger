<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 下午2:29
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\ThreadInterface;
use Casperlaitw\LaravelFbMessenger\Contracts\RequestType;

/**
 * Class StartButton
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class StartButton extends Message implements ThreadInterface
{
    use RequestType;

    /**
     * @var string
     */
    private $payload;

    /**
     * StartButton constructor.
     *
     * @param $payload
     */
    public function __construct($payload)
    {
        parent::__construct(null);
        $this->payload = $payload;
    }


    /**
     * Message to send
     * @return array
     */
    public function toData()
    {
        return [
            'setting_type' => 'call_to_actions',
            'thread_state' => 'new_thread',
            'call_to_actions' => [
                [
                    'payload' => $this->payload,
                ],
            ],
        ];
    }
}
