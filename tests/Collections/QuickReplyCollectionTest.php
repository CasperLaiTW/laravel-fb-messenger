<?php
use Casperlaitw\LaravelFbMessenger\Collections\QuickReplyCollection;
use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Messages\QuickReply;
use Mockery as m;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/10/13
 * Time: 上午12:57
 */
class QuickReplyCollectionTest extends TestCase
{
    public function test_pass_validator()
    {
        $collection = new QuickReplyCollection();
        $quickReply = m::mock(QuickReply::class);
        $this->assertTrue($collection->validator($quickReply));
    }

    public function test_validator_fail()
    {
        $this->expectException(ValidatorStructureException::class);

        $element = new QuickReplyCollection();
        $element->validator([]);
    }
}
