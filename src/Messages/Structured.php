<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午3:41
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Exceptions\UnknownTypeException;
use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Transformers\Factory;
use Illuminate\Support\Arr;
use pimax\Messages\MessageButton;
use pimax\Messages\MessageElement;
use pimax\Messages\StructuredMessage;

/**
 * Class StructuredMessage
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Structured extends Message
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $elements;

    /**
     * @var string
     */
    private $text = '';

    /**
     * StructuredMessage constructor.
     *
     * @param        $sender
     * @param string $type
     * @param array  $elements
     */
    public function __construct($sender, string $type, $elements = [])
    {
        parent::__construct($sender);
        $this->type = $type;
        $this->elements = $elements;
    }

    /**
     * @param $item
     *
     * @return $this
     * @throws ValidatorStructureException
     */
    public function add($item)
    {
        if (is_array($item)) {
            foreach ($item as $value) {
                $this->add($value);
            }
        } else {
            if ($this->validator($item)) {
                $this->elements[] = $item;
            }
        }

        return $this;
    }

    /**
     * Message to send object
     * @return \pimax\Messages\Message
     * @throws UnknownTypeException
     */
    public function toData()
    {
        return Factory::make($this->type)->transform($this);
    }

    /**
     * @param $item
     *
     * @return bool
     * @throws ValidatorStructureException
     */
    private function validator($item)
    {
        switch ($this->type) {
            case StructuredMessage::TYPE_BUTTON:
                if (!$item instanceof MessageButton) {
                    throw new ValidatorStructureException(
                        'The `button` structure item should be instance of `\\pimax\\Messages\\MessageButton`'.
                        json_encode($item)
                    );
                }
                break;
            case StructuredMessage::TYPE_GENERIC:
                if (!$item instanceof MessageElement) {
                    throw new ValidatorStructureException(
                        'The `generic` structure item should be instance of `\\pimax\\Messages\\MessageElement`'
                    );
                }
                break;
            case StructuredMessage::TYPE_RECEIPT:
                if (!Arr::has($item, [
                    'recipient_name',
                    'order_number',
                    'currency',
                    'payment_method',
                    'elements',
                    'summary'
                ])) {
                    throw new ValidatorStructureException('The `receipt` structure miss something required');
                }
                break;
        }

        return true;
    }

    /**
     * @param string $text
     *
     * @return Structured
     */
    public function setText(string $text): Structured
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return array
     */
    public function getElements(): array
    {
        return $this->elements;
    }
}
