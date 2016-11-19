<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午9:18
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Collections\ElementCollection;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Template;
use Casperlaitw\LaravelFbMessenger\Transformers\GenericTransformer;

/**
 * Class GenericTemplate
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class GenericTemplate extends Template
{
    /**
     * Generic constructor.
     *
     * @param $sender
     * @param $elements
     */
    public function __construct($sender, $elements = [])
    {
        parent::__construct($sender);
        $this->add($elements);
    }

    /**
     * To array for send api
     *
     * @return array
     */
    public function toData()
    {
        $payload = (new GenericTransformer)->transform($this);
        $this->setPayload($payload);

        return parent::toData();
    }

    /**
     * @return mixed
     */
    protected function collection()
    {
        return ElementCollection::class;
    }
}
