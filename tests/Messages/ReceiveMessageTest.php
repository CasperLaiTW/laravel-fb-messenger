<?php
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 下午4:33
 */
class ReceiveMessageTest extends PHPUnit_Framework_TestCase
{
    private $sender;

    private $message;

    private $payload;

    private $skip;

    public function setUp()
    {
        $this->message = str_random();
        $this->sender = str_random();
        $this->skip = true;
        $this->payload = false;
    }

    public function test_is_skip()
    {
        $actual = $this->getReceiveMessage();
        $this->assertEquals($this->skip, $actual->isSkip());
    }

    public function test_get_sender()
    {
        $actual = $this->getReceiveMessage();
        $this->assertEquals($this->sender, $actual->getSender());
    }

    public function test_get_message()
    {
        $actual = $this->getReceiveMessage();
        $this->assertEquals($this->message, $actual->getMessage());
    }

    public function test_is_payload()
    {
        $actual = $this->getReceiveMessage();
        $this->assertEquals($this->payload, $actual->isPayload());
    }

    private function getReceiveMessage()
    {
        return new ReceiveMessage($this->message, $this->sender, $this->skip, $this->payload);
    }
}
