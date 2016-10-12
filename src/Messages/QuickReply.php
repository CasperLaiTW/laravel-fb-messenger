<?php
/**
 * User: casperlai
 * Date: 2016/9/18
 * Time: 下午9:56
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;

/**
 * Class QuickReply
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class QuickReply extends Message
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $payload;

    /**
     * QuickReply constructor.
     *
     * @param $title
     * @param $payload
     */
    public function __construct($title, $payload)
    {
        parent::__construct(null);
        $this->title = $title;
        $this->payload = $payload;
    }

    /**
     * To array for send api
     * @return array
     */
    public function toData()
    {
        return [
            'content_type' => 'text',
            'title' => $this->title,
            'payload' => $this->payload,
        ];
    }
}
