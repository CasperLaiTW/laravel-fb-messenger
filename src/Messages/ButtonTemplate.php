<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午9:13
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Collections\ButtonCollection;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Template;
use Casperlaitw\LaravelFbMessenger\Transformers\ButtonTransformer;

/**
 * Class ButtonTemplate
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class ButtonTemplate extends Template
{
    /**
     * @var string
     */
    private $text;

    /**
     * Button constructor.
     *
     * @param        $sender
     * @param string $text
     * @param array  $elements
     */
    public function __construct($sender, $text = '', $elements = [])
    {
        parent::__construct($sender);
        $this->add($elements);
        $this->text = $text;
    }


    /**
     * To array for send api
     *
     * @return array
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\RequiredArgumentException
     */
    public function toData()
    {
        $payload = (new ButtonTransformer)->transform($this);
        $this->setPayload($payload);

        return parent::toData();
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return ButtonTemplate
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Get button collection
     *
     * @return mixed
     */
    protected function collection()
    {
        return ButtonCollection::class;
    }
}
