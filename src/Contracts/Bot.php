<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午3:15
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\ThreadInterface;
use pimax\FbBotApp;

/**
 * Class Bot
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
class Bot extends FbBotApp
{

    /**
     * Send message to API
     *
     * If instance of ThreadInterface, auto turn to thread_settings endpoint
     *
     * @param \pimax\Messages\Message|array $message
     * @param string                  $type
     *
     * @return HandleMessageResponse
     */
    public function send($message, $type = self::TYPE_POST)
    {
        if ($message instanceof ThreadInterface) {
            return $this->sendThreadSetting($message->toData(), $type);
        }

        if (is_array($message)) {
            return new HandleMessageResponse($this->call('me/messages', $message));
        }

        return new HandleMessageResponse(parent::send($message->toData()));
    }

    /**
     * Send thread_settings endpoint
     *
     * @param        $message
     * @param string $type
     *
     * @return HandleMessageResponse
     */
    protected function sendThreadSetting($message, $type = self::TYPE_POST)
    {
        return new HandleMessageResponse($this->call('me/thread_settings', $message, $type));
    }
}
