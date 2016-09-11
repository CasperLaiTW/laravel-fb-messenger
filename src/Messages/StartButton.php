<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 下午2:29
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

class StartButton extends Message implements ThreadInterface
{
    use Deletable;

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
     * Message to send object
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
