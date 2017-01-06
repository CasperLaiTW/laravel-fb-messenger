<?php
/**
 * User: casperlai
 * Date: 2016/9/2
 * Time: 下午9:34
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\ThreadInterface;
use Casperlaitw\LaravelFbMessenger\Contracts\RequestType;

/**
 * Class PersistentMenuMessage
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class PersistentMenuMessage extends Message implements ThreadInterface
{
    use RequestType;

    /**
     * @var
     */
    private $buttons;

    /**
     * PersistentMenuMessage constructor.
     *
     * @param $buttons
     */
    public function __construct($buttons = [])
    {
        parent::__construct(null);
        $this->buttons = $buttons;
    }

    /**
     * Message to send
     * @return array
     */
    public function toData()
    {
        $buttons = collect($this->buttons);
        return [
            'setting_type' => 'call_to_actions',
            'thread_state' => 'existing_thread',
            'call_to_actions' => $buttons->map(function (Button $item) {
                return $item->toData();
            })->toArray(),
        ];
    }
}
