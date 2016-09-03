<?php
use Casperlaitw\LaravelFbMessenger\Messages\Image;
use pimax\Messages\ImageMessage;

/**
 * User: casperlai
 * Date: 2016/9/3
 * Time: 下午4:32
 */
class ImageTest extends PHPUnit_Framework_TestCase
{
    public function test_to_data()
    {
        $sender = str_random();
        $image = str_random();
        $expected = new ImageMessage($sender, $image);

        $this->assertEquals($expected, (new Image($sender, $image))->toData());
    }
}
