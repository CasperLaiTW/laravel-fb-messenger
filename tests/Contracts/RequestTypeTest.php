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
}
