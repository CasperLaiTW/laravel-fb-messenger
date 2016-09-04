<?php

use Casperlaitw\LaravelFbMessenger\Contracts\Bot;
use Casperlaitw\LaravelFbMessenger\Messages\Deletable;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 下午4:16
 */
class DeletableTest extends PHPUnit_Framework_TestCase
{

    protected function tearDown()
    {
        m::close();
    }

    public function test_get_curl_type()
    {
        $mock = $this->getMockForTrait(Deletable::class);
        $mock->setDelete(true);
        $this->assertEquals(Bot::TYPE_DELETE, $mock->getCurlType());
    }
}
