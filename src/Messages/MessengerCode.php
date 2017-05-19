<?php

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\CodeInterface;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;

/**
 * Class MessengerCode
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class MessengerCode extends Message implements CodeInterface
{

    /**
     * @var
     */
    private $imageSize;

    /**
     * @var
     */
    private $ref;

    /**
     * MessengerCode constructor.
     */
    public function __construct()
    {
        parent::__construct(null);
    }


    /**
     * @param $value
     * @return $this
     */
    public function setImageSize($value)
    {
        $this->imageSize = $value;

        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setRef($value)
    {
        $this->ref = [
            'ref' => $value,
        ];

        return $this;
    }

    /**
     * To array for send api
     * @return array
     */
    public function toData()
    {
        $data = [
            'type' => 'standard',
        ];

        if ($this->imageSize) {
            $data['image_size'] = $this->imageSize;
        }

        if ($this->ref) {
            $data['data'] = $this->ref;
        }


        return $data;
    }
}
