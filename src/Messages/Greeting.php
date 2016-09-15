<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午3:27
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\ThreadInterface;

/**
 * Class Greeting
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Greeting extends Message implements ThreadInterface
{
    /**
     * @var string
     */
    private $greeting;

    /**
     * Greeting constructor.
     *
     * @param $greeting
     */
    public function __construct($greeting)
    {
        parent::__construct(null);
        $this->greeting = $greeting;
    }

    /**
     * Message to send
     *
     * @return array
     */
    public function toData()
    {
        return [
            'setting_type' => 'greeting',
            'greeting' => [
                'text' => $this->greeting,
            ],
        ];
    }
}
