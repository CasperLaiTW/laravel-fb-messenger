<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午9:13
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Transformers\ButtonTransformer;
use pimax\Messages\MessageButton;

class Button extends Structured
{

    /**
     * Button constructor.
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
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\RequiredArgumentException
     */
    public function toData()
    {
        return (new ButtonTransformer)->transform($this);
    }

    /**
     * Valid the added element
     * @param $elements
     *
     * @return mixed
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException
     */
    public function validator($elements)
    {
        if (!$elements instanceof MessageButton) {
            throw new ValidatorStructureException(
                'The `button` structure item should be instance of `\\pimax\\Messages\\MessageButton`'
            );
        }

        return true;
    }
}
