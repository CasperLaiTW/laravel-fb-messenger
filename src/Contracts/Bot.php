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
     * FbBotApp constructor.
     * @param string $token
     */
    public function __construct($token)
    {
        $this->client = new Client(['base_uri' => $this->apiUrl]);
        $this->token = $token;
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
            $response = $this->client->request(
                $type,
                $url,
                [
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ],
                    'body' => json_encode($data),
                    'query' => [
                        'access_token' => $this->token,
                    ],
                ]
            );
            return json_decode($response->getBody(), true);
        } catch (ClientException $ex) {
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
}
