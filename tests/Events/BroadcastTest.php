<?php
use Casperlaitw\LaravelFbMessenger\Events\Broadcast;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/20
 * Time: 下午3:44
 */
class BroadcastTest extends TestCase
{
    private $id;
    private $response;
    private $code;
    private $webhook;
    private $request;
    private $broadcast;

    public function setUp()
    {
        parent::setUp();

        $this->id = $this->response = $this->code = $this->webhook = $this->request = str_random();
        $this->broadcast = new Broadcast($this->id, $this->webhook, $this->request, $this->response, $this->code);
    }

    public function test_broadcast_on()
    {
        $this->assertEquals(['laravel-fb-messenger'], $this->broadcast->broadcastOn());
    }

    public function test_broadcast_with()
    {
        $this->assertEquals([
            'id' => $this->id,
            'webhook' => $this->webhook,
            'request' => $this->request,
            'response' => $this->response,
            'status' => $this->code,
        ], $this->broadcast->broadcastWith());
    }
}
