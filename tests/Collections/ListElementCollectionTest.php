<?php
use Casperlaitw\LaravelFbMessenger\Collections\ListElementCollection;
use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Messages\ListElement;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/14
 * Time: 下午10:48
 */
class ListElementCollectionTest extends TestCase
{
    public function test_add_element()
    {
        $element = new ListElementCollection();
        $title = 'title';
        $description = 'description';
        $image_url = 'image_url';
        $element->addElement($title, $description, $image_url);

        $expected = new ListElement($title, $description, $image_url);

        $this->assertEquals($expected, $element->getElements()[0]);
    }

    public function test_validator()
    {
        $this->expectException(ValidatorStructureException::class);

        $element = new ListElementCollection();
        $element->validator([]);
    }
}
