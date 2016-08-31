<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午3:15
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use pimax\FbBotApp;

/**
 * Class Bot
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
class Bot extends FbBotApp
{

    /**
     * @param        $message
     * @param string $type
     *
     * @return array
     */
    public function sendThreadSetting($message, $type = self::TYPE_POST)
    {
        return $this->call('me/thread_settings', $message->toData(), $type);
    }

    /**
     * @param $text
     *
     * @return array
     */
    public function setGreeting($text)
    {
        return $this->call('me/thread_settings', [
            'setting_type' => 'greeting',
            'greeting' => [
                'text' => $text,
            ],
        ]);
    }

    /**
     * @return array
     */
    public function deleteGreeting()
    {
        return $this->call([
            'setting_type' => 'greeting',
        ], self::TYPE_DELETE);
    }
}
