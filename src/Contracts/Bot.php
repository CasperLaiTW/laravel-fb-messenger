<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午3:15
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\UserInterface;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\ThreadInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Broadcasting\BroadcastException;

/**
 * Class Bot
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
class Bot
{
    /**
     * Request type GET
     */
    const TYPE_GET = 'get';

    /**
     * Request type POST
     */
    const TYPE_POST = 'post';

    /**
     * Request type DELETE
     */
    const TYPE_DELETE = 'delete';

    /**
     * FB Messenger API Url
     *
     * @var string
     */
    protected $apiUrl = 'https://graph.facebook.com/v2.6/';

    /**
     * @var null|string
     */
    protected $token = null;

    /**
     * @var null
     */
    private $debug = null;

    /**
     * FbBotApp constructor.
     * @param string $token
     */
    public function __construct($token)
    {
        $this->client = new Client(['base_uri' => $this->apiUrl]);
        $this->token = $token;
    }

    /**
     * @param $debug
     */
    public function setDebug($debug)
    {
        $this->debug = $debug;
    }

    /**
     * Request to API
     *
     * @param string $url
     * @param array  $data
     * @param string $type Type of request (GET|POST|DELETE)
     *
     * @return array
     * @throws \RuntimeException
     */
    protected function call($url, $data, $type = self::TYPE_POST)
    {
        try {
            $options = [
                'query' => [
                    'access_token' => $this->token,
                ],
            ];

            switch ($type) {
                case self::TYPE_DELETE:
                case self::TYPE_POST:
                    $options = array_merge($options, [
                        'headers' => [
                            'Content-Type' => 'application/json'
                        ],
                        'body' => json_encode($data),
                    ]);
                    break;
                case self::TYPE_GET:
                    $options['query'] = array_merge($options['query'], $data);
                    break;
            }

            $response = $this->client->request(
                $type,
                $url,
                $options
            );

            $this->debug($data, $response->getBody(), $response->getStatusCode());

            return json_decode($response->getBody(), true);
        } catch (ClientException $ex) {
            $this->debug($data, $ex->getResponse()->getBody(), $ex->getResponse()->getStatusCode());

            return json_decode($ex->getResponse()->getBody(), true);
        }
    }

    /**
     * Send message to API
     *
     * If instance of ThreadInterface, auto turn to thread_settings endpoint
     *
     * @param Message $message
     * @param string $type
     *
     * @return HandleMessageResponse|array
     * @throws \RuntimeException
     */
    public function send($message, $type = self::TYPE_POST)
    {
        if ($message instanceof ThreadInterface) {
            return $this->sendThreadSetting($message->toData(), $type);
        }

        if ($message instanceof UserInterface) {
            return $this->sendUserApi($message);
        }

        return $this->sendMessage($message->toData());
    }

    /**
     * @param $message
     *
     * @return HandleMessageResponse
     */
    protected function sendMessage($message)
    {
        return new HandleMessageResponse($this->call('me/messages', $message));
    }

    /**
     * Send thread_settings endpoint
     *
     * @param array $message
     * @param string $type
     *
     * @return HandleMessageResponse
     */
    protected function sendThreadSetting($message, $type = self::TYPE_POST)
    {
        return new HandleMessageResponse($this->call('me/thread_settings', $message, $type));
    }

    /**
     * Send user endpoint
     *
     * @param $message
     * @return array
     * @throws \RuntimeException
     */
    protected function sendUserApi($message)
    {
        return $this->call($message->getSender(), [], self::TYPE_GET);
    }

    /**
     * @param $request
     * @param $response
     * @param $status
     */
    protected function debug($request, $response, $status)
    {
        if ($this->debug === null) {
            return;
        }
        try {
            $this->debug->setRequest($request)->setResponse(json_decode($response))->setStatus($status)->broadcast();
        } catch (BroadcastException $ex) {
            return;
        }
    }
}
