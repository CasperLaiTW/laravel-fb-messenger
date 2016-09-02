<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午3:15
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Messages\ThreadInterface;
use pimax\FbBotApp;

/**
 * Class Bot
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
class Bot extends FbBotApp
{

    /**
     * @param \pimax\Messages\Message $message
     * @param string                  $type
     *
     * @return HandleMessageResponse
     */
    public function send($message, $type = self::TYPE_POST)
    {
        if ($message instanceof ThreadInterface) {
            return $this->sendThreadSetting($message->toData(), $type);
        }

        return new HandleMessageResponse(parent::send($message->toData()));
    }

    /**
     * @param        $message
     * @param string $type
     *
     * @return HandleMessageResponse
     */
    protected function sendThreadSetting($message, $type = self::TYPE_POST)
    {
        return new HandleMessageResponse($this->call('me/thread_settings', $message, $type));
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
