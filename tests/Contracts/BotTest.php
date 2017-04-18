<?php
use Casperlaitw\LaravelFbMessenger\Contracts\Bot;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Contracts\Debug\Debug;
use Casperlaitw\LaravelFbMessenger\Messages\Greeting;
use Casperlaitw\LaravelFbMessenger\Messages\User;
use Illuminate\Broadcasting\BroadcastException;
use Illuminate\Events\Dispatcher;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/10
 * Time: 下午11:50
 */
class BotTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->bot = new Bot(getenv('MESSENGER_APP_TOKEN'));
    }

    public function test_send_success()
    {
        $message = new Greeting(str_random());
        $this->bot->send($message);
    }

    public function test_get_user()
    {
        $user = new User('1282081671850626');
        $response = $this->bot->send($user);

        $this->assertEquals('Casper', $response['first_name']);
    }

    public function test_send_array_message()
    {
        $message = m::mock(Message::class);
        $message
            ->shouldReceive('toData')
            ->andReturn([]);
        $this->bot->send($message);
    }

    public function test_debug_mode()
    {
        $dispatch = m::mock(Dispatcher::class);
        $dispatch
            ->shouldReceive('fire')
            ->andReturnNull();
        $debug = new Debug($dispatch);
        $this->bot->setDebug($debug);
        $message = m::mock(Message::class);
        $message
            ->shouldReceive('toData')
            ->andReturn([]);
        $this->bot->send($message);
    }

    public function test_pusher_connect_fail()
    {
        $dispatch = m::mock(Dispatcher::class);
        $debug = m::mock(Debug::class.'[broadcast]', [$dispatch]);
        $debug
            ->shouldReceive('broadcast')
            ->andReturnUsing(function () {
                throw new BroadcastException();
            });

        $this->bot->setDebug($debug);
        $message = m::mock(Message::class);
        $message
            ->shouldReceive('toData')
            ->andReturn([]);
        $this->bot->send($message);
    }

    public function test_securing_request()
    {
        $appSecret = 'test_app_secret';
        $expected = hash_hmac('sha256', getenv('MESSENGER_APP_TOKEN'), $appSecret);
        $this->bot->setSecret($appSecret);
        $actual = $this->getPrivateProperty(Bot::class, 'secret')->getValue($this->bot);

        $this->assertEquals($expected, $actual);
    }
}
