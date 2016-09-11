<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 下午10:59
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Illuminate\Container\Container;

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
     * @param BaseHandler $handler
     * @param             $token
     * @param array       $postbacks
     */
    public function __construct(BaseHandler $handler, $token, $postbacks = [])
    {
        $this->handler = $handler->createBot($token);
        $this->createPostbacks($postbacks);
    }

    /**
     * Create postbacks
     *
     * @param $postbacks
     */
    private function createPostbacks($postbacks)
    {
        $app = new Container();
        foreach ($postbacks as $item) {
            $postback = $app->make($item);
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
            if ($message->isPayload()) {
                if (array_key_exists($message->getMessage(), $this->postbacks)) {
                    $this->postbacks[$message->getMessage()]->handle($message);
                }
                return;
            }

            $this->handler->handle($message);
        });
    }
}
