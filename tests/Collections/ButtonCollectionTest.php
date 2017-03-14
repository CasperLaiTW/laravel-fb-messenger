<?php
use Casperlaitw\LaravelFbMessenger\Collections\ButtonCollection;
use Casperlaitw\LaravelFbMessenger\Exceptions\OnlyUseByItselfException;
use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Messages\Button;
use Faker\Factory;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午11:57
 */
class ButtonCollectionTest extends TestCase
{
    public function test_validator_fail()
    {
        $this->expectException(ValidatorStructureException::class);

        $collection = new ButtonCollection();
        $collection->validator([]);
    }

    public function test_pass_validator()
    {
        $collection = new ButtonCollection();
        $button = m::mock(Button::class);
        $this->assertTrue($collection->validator($button));
    }

    public function test_add_postback_button()
    {
        $collection = new ButtonCollection();
        $text = 'test';
        $url = 'abc';
        $collection->addPostBackButton('test', 'abc');
        $expected = new Button(Button::TYPE_POSTBACK, $text, $url);

        $this->assertEquals($expected, $collection->getElements()[0]);
    }

    public function test_add_web_button()
    {
        $collection = new ButtonCollection();
        $text = 'test';
        $url = 'abc';
        $collection->addWebButton($text, $url);

        $expected = new Button(Button::TYPE_WEB, $text, $url);
        $this->assertEquals($expected, $collection->getElements()[0]);
    }

    public function test_add_call_button()
    {
        $fake = Factory::create();
        $collection = new ButtonCollection();
        $title = str_random();
        $phone = $fake->phoneNumber;
        $collection->addCallButton($title, $phone);

        $expected = new Button(Button::TYPE_CALL, $title, $phone);
        $this->assertEquals($expected, $collection->getElements()[0]);
    }

    public function test_add_share_button()
    {
        $collection = new ButtonCollection();
        $collection->addShareButton();
        $expected = new Button(Button::TYPE_SHARE, '');

        $this->assertEquals($expected, $collection->getElements()[0]);
    }

    public function test_add_account_link_button()
    {
        $url = str_random();
        $collection = new ButtonCollection();
        $collection->addAccountLinkButton($url);
        $expected = new Button(Button::TYPE_ACCOUNT_LINK, null, $url);

        $this->assertEquals($expected, $collection->getElements()[0]);
    }
}
