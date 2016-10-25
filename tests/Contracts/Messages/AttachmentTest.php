<?php
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Attachment;
use Casperlaitw\LaravelFbMessenger\Exceptions\InvalidTypeException;
use Faker\Factory;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/15
 * Time: 下午9:46
 */
class AttachmentTest extends TestCase
{
    /**
     * @var Attachment
     */
    private $attachment;

    private $faker;

    protected function setUp()
    {
        parent::setUp();
        $this->faker = Factory::create();
        $sender = str_random();
        $type = Attachment::TYPE_IMAGE;
        $image = $this->faker->url;
        $this->attachment = new AttachmentStub($sender, $type, ['url' => $image]);
    }

    public function test_set_payload()
    {
        $expected = [
            'url' => $this->faker->url,
        ];
        $this->attachment->setPayload($expected);
        $this->assertEquals($expected, $this->attachment->getPayload());
    }

    public function test_payload_is_not_array()
    {
        $this->expectException(interface_exists('Throwable') ? Throwable::class : PHPUnit_Framework_Error::class);
        $this->attachment->setPayload('');
    }

    public function test_enable_reuse()
    {
        $this->attachment->enableReuse();
        $this->assertArraySubset(['is_reusable' => true], $this->attachment->getPayload());
    }

    public function test_disable_reuse()
    {
        $this->attachment->disableReuse();
        $this->assertArrayNotHasKey('is_reusable', $this->attachment->getPayload());
    }

    public function test_set_attachment_id()
    {
        $id = str_random();
        $this->attachment->setAttachmentId($id);

        $this->assertEquals(['attachment_id' => $id], $this->attachment->getPayload());
        $this->assertArrayNotHasKey('url', $this->attachment->getPayload());
    }
}

class AttachmentStub extends Attachment
{
}
