<?php
use Casperlaitw\LaravelFbMessenger\Collections\ButtonCollection;
use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Mockery as m;
use pimax\Messages\MessageButton;

/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午11:57
 */
class ButtonCollectionTest extends TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function test_validator_fail()
    {
        $this->expectException(ValidatorStructureException::class);

        $collection = new ButtonCollection();
        $collection->validator([]);
    }

    public function test_pass_validator()
    {
        $collection = new ButtonCollection();
        $button = m::mock(MessageButton::class);
        $this->assertTrue($collection->validator($button));
    }

    public function test_add_postback_button()
    {
        $collection = new ButtonCollection();
        $text = 'test';
        $url = 'abc';
        $collection->addPostBackButton('test', 'abc');
        $expected = new MessageButton(MessageButton::TYPE_POSTBACK, $text, $url);

        $this->assertEquals($expected, $collection->getElements()[0]);
    }

    public function test_add_web_button()
    {
        $collection = new ButtonCollection();
        $text = 'test';
        $url = 'abc';
        $collection->addWebButton($text, $url);

        $expected = new MessageButton(MessageButton::TYPE_WEB, $text, $url);
        $this->assertEquals($expected, $collection->getElements()[0]);
    }
}
