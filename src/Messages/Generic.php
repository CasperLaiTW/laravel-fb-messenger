<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午9:18
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Transformers\GenericTransformer;
use pimax\Messages\MessageElement;

class Generic extends Structured
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
     * Message to send object
     * @return \pimax\Messages\Message
     */
    public function toData()
    {
        return (new GenericTransformer)->transform($this);
    }

    /**
     * @param $elements
     *
     * @return mixed
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException
     */
    public function validator($elements)
    {
        if (!$elements instanceof MessageElement) {
            throw new ValidatorStructureException(
                'The `generic` structure item should be instance of `\\pimax\\Messages\\MessageElement`'
            );
        }

        return true;
    }
}
