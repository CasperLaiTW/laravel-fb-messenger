<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午12:35
 */

namespace Casperlaitw\LaravelFbMessenger\Controllers;

use Casperlaitw\LaravelFbMessenger\Contracts\WebhookHandler;
use Casperlaitw\LaravelFbMessenger\Contracts\Debug\Debug;
use Casperlaitw\LaravelFbMessenger\Messages\Receiver;
use Casperlaitw\LaravelFbMessenger\Middleware\RequestReceived;
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
     * @var Debug
     */
    private $debug;

    /**
     * WebhookController constructor.
     *
     * @param Repository $config
     * @param Debug $debug
     */
    public function __construct(Repository $config, Debug $debug)
    {
        $this->config = $config;
        $this->debug = $debug;
        if ($this->config->get('fb-messenger.debug')) {
            $this->middleware(RequestReceived::class);
        }
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
     */
    public function receive(Request $request)
    {
        $receive = new Receiver($request);
        $webhook = new WebhookHandler($receive->getMessages(), $this->config, $this->debug);
        $webhook->handle();
    }
}
