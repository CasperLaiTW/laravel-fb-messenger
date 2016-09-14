<?php
use Casperlaitw\LaravelFbMessenger\Contracts\Bot;
use Casperlaitw\LaravelFbMessenger\Messages\Greeting;
use Casperlaitw\LaravelFbMessenger\Messages\Text;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/10
 * Time: 下午11:50
 */
class BotTest extends TestCase
{
    public function test_parent_send()
    {
        $bot = new Bot(getenv('MESSENGER_APP_TOKEN'));
        $message = new Text(str_random(), str_random());
        $bot->send($message);
    }

    public function test_send_thread_setting()
    {
        $message = m::mock(Greeting::class);
        $message
            ->shouldReceive('toData')
            ->andReturn([]);
        $bot = new Bot(getenv('MESSENGER_APP_TOKEN'));
        $bot->send($message);
    }
}
