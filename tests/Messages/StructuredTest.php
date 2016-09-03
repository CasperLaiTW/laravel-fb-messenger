<?php

use Casperlaitw\LaravelFbMessenger\Messages\Button;
use pimax\Messages\MessageButton;

/**
 * User: casperlai
 * Date: 2016/9/4
 * Time: 上午12:55
 */
class StructuredTest extends PHPUnit_Framework_TestCase
{
    public function test_call_method()
    {
        $button = new Button(str_random(), str_random());
        $this->assertTrue($button->validator($this->getMessageButtonMock()));
    }

    private function getMessageButtonMock()
    {
        return $this->createMock(MessageButton::class);
    }
}
