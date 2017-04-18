<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午3:27
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\ProfileInterface;

/**
 * Class Greeting
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Greeting extends Message implements ProfileInterface
{
    /**
     * @var array
     */
    private $greetings;

    /**
     * Greeting constructor.
     *
     * @param array $greetings
     */
    public function __construct($greetings)
    {
        parent::__construct(null);
        $this->greetings = $greetings;
    }

    /**
     * Message to send
     *
     * @return array
     */
    public function toData()
    {
        return [
            'greeting' => $this->greetings,
        ];
    }
}
