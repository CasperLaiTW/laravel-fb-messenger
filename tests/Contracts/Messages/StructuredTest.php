<?php

use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Mockery as m;
use pimax\Messages\MessageButton;

/**
 * User: casperlai
 * Date: 2016/9/4
 * Time: 上午12:55
 */
class StructuredTest extends TestCase
{
    public function test_call_method()
    {
        $button = new Button(str_random(), str_random());
        $this->assertTrue($button->validator($this->getMessageButtonMock()));
    }

    public function test_non_collection_method()
    {
        $button = new Button(str_random(), str_random());
        $button->getError();
    }

    private function getMessageButtonMock()
    {
        return m::mock(MessageButton::class)->makePartial();
    }
}