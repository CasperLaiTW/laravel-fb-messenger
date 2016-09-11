<?php
use Casperlaitw\LaravelFbMessenger\Contracts\Bot;
use Casperlaitw\LaravelFbMessenger\Messages\Text;

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
        $response = $bot->send($message);
        $this->assertStringStartsWith('(#100)', $response->getResponse());
    }
}
