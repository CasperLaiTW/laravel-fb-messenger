<?php

use Casperlaitw\LaravelFbMessenger\Collections\ElementCollection;
use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Messages\Element;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午12:26
 */
class ElementCollectionTest extends TestCase
{
    public function test_add_element()
    {
        $element = new ElementCollection();
        $title = 'title';
        $description = 'description';
        $element->addElement($title, $description);

        $expected = new Element($title, $description);

        $this->assertEquals($expected, $element->getElements()[0]);
    }

    public function test_to_array()
    {
        $element = new ElementCollection();
        $elementMessages = [
            new Element('title1', 'description1'),
            new Element('title2', 'description2'),
        ];
        foreach ($elementMessages as $message) {
            $element->add($message);
        }
        foreach ($element->toData() as $key => $value) {
            $this->assertEquals($elementMessages[$key]->toData(), $value);
        }
    }

    public function test_validator_fail()
    {
        $this->expectException(ValidatorStructureException::class);

        $element = new ElementCollection();
        $element->validator([]);
    }
}
