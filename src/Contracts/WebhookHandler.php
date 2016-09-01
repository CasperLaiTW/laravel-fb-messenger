<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 下午10:59
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;

/**
 * Class WebhookHandler
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
class WebhookHandler
{
    /**
     * @var BaseHandler
     */
    private $handler;

    /**
     * @var array
     */
    private $postbacks;

    /**
     * WebhookHandler constructor.
     *
     * @param       $handler
     */
    public function __construct(BaseHandler $handler)
    {
        $this->handler = $handler;
        $this->createPostbacks();
    }

    /**
     * Create postbacks
     */
    private function createPostbacks()
    {
        $postbacks = config('fb-messenger.postbacks');
        foreach ($postbacks as $item) {
            $postback = app($item);
            if ($postback instanceof PostbackHandler) {
                $this->postbacks[$postback->getPayload()] = $postback;
            }
        }
    }

    /**
     * Handle webhook
     */
    public function handle()
    {
        $this->handler->getMessages()->each(function (ReceiveMessage $message) {
            if ($message->isPayload() && array_key_exists($message->getMessage(), $this->postbacks)) {
                $this->postbacks[$message->getMessage()]->handle($message);
                return;
            }

            $this->handler->handle($message);
        });
    }
}
