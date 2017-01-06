<?php

use Casperlaitw\LaravelFbMessenger\Contracts\Bot;
use Casperlaitw\LaravelFbMessenger\Contracts\RequestType;

class RequestTypeTest extends TestCase
{
    public function test_use_post()
    {
        $mock = $this->getMockForTrait(RequestType::class);

        $mock->usePost();

        $this->assertEquals(Bot::TYPE_POST, $mock->getCurlType());
    }

    public function test_use_delete()
    {
        $mock = $this->getMockForTrait(RequestType::class);

        $mock->useDelete();

        $this->assertEquals(Bot::TYPE_DELETE, $mock->getCurlType());
    }

    public function test_use_get()
    {
        $mock = $this->getMockForTrait(RequestType::class);

        $mock->useGet();

        $this->assertEquals(Bot::TYPE_GET, $mock->getCurlType());
    }
}
