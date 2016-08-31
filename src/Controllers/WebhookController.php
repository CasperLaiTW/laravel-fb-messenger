<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午12:35
 */

namespace Casperlaitw\LaravelFbMessenger\Controllers;

use Casperlaitw\LaravelFbMessenger\Contracts\BaseHandler;
use Casperlaitw\LaravelFbMessenger\Exceptions\NeedImplementHandlerException;
use Casperlaitw\LaravelFbMessenger\Messages\Receiver;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

/**
 * Class WebhookController
 * @package Casperlaitw\LaravelFbMessenger\Controllers
 */
class WebhookController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response|void
     */
    public function index(Request $request)
    {
        if ($request->get('hub_mode') === 'subscribe'
            && $request->get('hub_verify_token') === config('fb-messenger.verify_token')) {
            return response($request->get('hub_challenge'));
        }

        return abort(404);
    }

    /**
     * @param Request $request
     *
     * @throws NeedImplementHandlerException
     */
    public function receive(Request $request)
    {
        $receive = new Receiver($request);
        $handleClassName = config('fb-messenger.handler');
        $handle = new $handleClassName($receive->getMessages());
        if (!$handle instanceof BaseHandler) {
            throw new NeedImplementHandlerException();
        }
        $handle->handle();
    }
}
