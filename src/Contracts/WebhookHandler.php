<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 下午10:59
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Collections\ReceiveMessageCollection;
use Casperlaitw\LaravelFbMessenger\Contracts\Debug\Debug;
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;

/**
 * Class WebhookHandler
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
class WebhookHandler
{
    /**
     * @var array
     */
    private $handlers;

    /**
     * @var array
     */
    private $postbacks = [];

    /**
     * Access token
     * @var string
     */
    private $token;

    /**
     * @var ReceiveMessageCollection
     */
    private $messages;

    /**
     * @var Container
     */
    private $app;

    /**
     * @var Repository
     */
    private $config;
    /**
     * @var Debug
     */
    private $debug;

    /**
     * WebhookHandler constructor.
     *
     * @param ReceiveMessageCollection $messages
     * @param Repository $config
     * @param Debug $debug
     */
    public function __construct(
        ReceiveMessageCollection $messages,
        Repository $config,
        Debug $debug
    ) {
        $this->app = new Container();
        $this->messages = $messages;
        $this->config = $config;
        $this->debug = $debug;
    }

    /**
     * Boot to initialize process
     *
     * @return $this
     */
    public function boot()
    {
        $this->createHandler();
        $this->createPostbacks();
        return $this;
    }

    /**
     * Create handlers
     */
    private function createHandler()
    {
        $handlers = $this->config->get('fb-messenger.handlers');
        foreach ($handlers as $item) {
            $handler = $this->app->make($item);
            if ($handler instanceof BaseHandler) {
                $this->handlers[] = $this->createBot($handler);
            }
        }
    }
    /**
     * Create postbacks
     *
     */
    private function createPostbacks()
    {
        $postbacks = $this->config->get('fb-messenger.postbacks');
        foreach ($postbacks as $item) {
            $postback = $this->app->make($item);
            if ($postback instanceof PostbackHandler) {
                $this->postbacks[$postback->getPayload()] = $this->createBot($postback);
            }
        }
    }

    /**
     * Handle auto type
     */
    private function autoTypeHandle($message)
    {
        $autoTyping = $this->config->get('fb-messenger.auto_typing');
        if ($autoTyping) {
            $handler = $this->createBot($this->app->make(AutoTypingHandler::class));
            $handler->handle($message);
        }
    }

    /**
     * Handle webhook
     */
    public function handle()
    {
        $this->boot();
        $postbackKeys = array_keys($this->postbacks);
        $this->messages->each(function (ReceiveMessage $message) use ($postbackKeys) {
            $this->autoTypeHandle($message);
            if ($message->isPayload()) {
                foreach ($postbackKeys as $postbackKey) {
                    if (preg_match("/$postbackKey/", $message->getPostback())) {
                        $this->postbacks[$postbackKey]->handle($message);
                        break;
                    }
                }
                return;
            }

            foreach ($this->handlers as $handler) {
                $handler->handle($message);
            }
            $this->debug->clear();
        });
    }

    /**
     * Create bot
     *
     * @param $handler
     * @return mixed
     */
    protected function createBot($handler)
    {
        $bot = $handler->createBot(
            $this->config->get('fb-messenger.app_token'),
            $this->config->get('fb-messenger.app_secret')
        );
        if ($this->config->get('fb-messenger.debug')) {
            $bot->debug($this->debug);
        }

        return $bot;
    }
}
