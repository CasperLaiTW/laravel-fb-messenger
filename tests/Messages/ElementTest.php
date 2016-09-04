<?php
use Casperlaitw\LaravelFbMessenger\Collections\ButtonCollection;
use Casperlaitw\LaravelFbMessenger\Messages\Element;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 上午1:53
 */

class ElementTest extends TestCase
{
    public function test_button()
    {
        $element = new Element(str_random(), str_random());
        $this->assertInstanceOf(ButtonCollection::class, $element->buttons());
    }
}
