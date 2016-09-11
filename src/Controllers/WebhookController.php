<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午12:35
 */

namespace Casperlaitw\LaravelFbMessenger\Controllers;

use Casperlaitw\LaravelFbMessenger\Contracts\BaseHandler;
use Casperlaitw\LaravelFbMessenger\Contracts\WebhookHandler;
use Casperlaitw\LaravelFbMessenger\Exceptions\NeedImplementHandlerException;
use Casperlaitw\LaravelFbMessenger\Messages\Receiver;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class WebhookController
 * @package Casperlaitw\LaravelFbMessenger\Controllers
 */
class WebhookController extends Controller
{
    /**
     * @var Repository
     */
    private $config;

    /**
     * WebhookController constructor.
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Webhook verify request
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response|void
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @throws \InvalidArgumentException
     */
    public function index(Request $request)
    {
        if ($request->get('hub_mode') === 'subscribe'
            && $request->get('hub_verify_token') === $this->config->get('fb-messenger.verify_token')) {
            return new Response($request->get('hub_challenge'));
        }

        throw new NotFoundHttpException('Not found resources');
    }

    /**
     * Receive the webhook request
     *
     * @param Request $request
     *
     * @throws NeedImplementHandlerException
     */
    public function receive(Request $request)
    {
        $app = new Container();
        $receive = new Receiver($request);
        $handlerClassName = $this->config->get('fb-messenger.handler');
        $token = $this->config->get('fb-messenger.app_token');
        $handler = $app->make($handlerClassName);
        if (!$handler instanceof BaseHandler) {
            throw new NeedImplementHandlerException();
        }

        $handler->setMessages($receive->getMessages());
        $webhook = new WebhookHandler($handler, $token);
        $webhook->handle();
    }
}
