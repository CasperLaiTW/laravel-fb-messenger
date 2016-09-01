<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午3:27
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

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
