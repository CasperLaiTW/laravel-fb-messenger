<?php
use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 下午4:33
 */
class ReceiveMessageTest extends TestCase
{
    private $sender;

    private $message;

    private $payload;

    private $skip;

    private $postback;

    private $recipient;

    private $attachments;

    public function setUp()
    {
        $this->message = str_random();
        $this->recipient = str_random();
        $this->sender = str_random();
        $this->postback = str_random();
        $this->attachments = [];
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

    public function test_get_postback()
    {
        $actual = $this->getReceiveMessage();
        $this->assertEquals($this->postback, $actual->getPostback());
    }

    public function test_get_recipient()
    {
        $actual = $this->getReceiveMessage();
        $this->assertEquals($this->recipient, $actual->getRecipient());
    }

    public function test_get_attachments()
    {
        $actual = $this->getReceiveMessage();
        $this->assertEquals($this->attachments, $actual->getAttachments());
    }

    public function test_has_attachments()
    {
        $actual = $this->getReceiveMessage();
        $this->assertFalse($actual->hasAttachments());
    }

    private function getReceiveMessage()
    {
        $message = new ReceiveMessage($this->recipient, $this->sender);
        $message
            ->setMessage($this->message)
            ->setPostback($this->postback)
            ->setSkip($this->skip)
            ->setPayload($this->payload)
            ->setAttachments($this->attachments);
        return $message;
    }
}
