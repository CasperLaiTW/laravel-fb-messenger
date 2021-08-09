<?php

use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Casperlaitw\LaravelFbMessenger\Messages\ButtonTemplate;
use Illuminate\Support\Str;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/4
 * Time: 上午12:55
 */
class StructuredTest extends TestCase
{
    public function test_call_method()
    {
        $button = new ButtonTemplate(Str::random(), Str::random());
        $this->assertTrue($button->validator($this->getMessageButtonMock()));
    }

    public function test_non_collection_method()
    {
        $button = new ButtonTemplate(Str::random(), Str::random());
        $button->getError();
    }

    private function getMessageButtonMock()
    {
        return m::mock(Button::class)->makePartial();
    }
}
