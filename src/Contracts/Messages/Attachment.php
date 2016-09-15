<?php
/**
 * User: casperlai
 * Date: 2016/9/15
 * Time: 下午8:00
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts\Messages;

/**
 * Class Attachment
 * @package Casperlaitw\LaravelFbMessenger\Contracts\Messages
 */
abstract class Attachment extends Message
{
    /**
     *
     */
    const TYPE_IMAGE = 'image';

    /**
     *
     */
    const TYPE_AUDIO = 'audio';

    /**
     *
     */
    const TYPE_VIDEO = 'video';

    /**
     *
     */
    const TYPE_FILE = 'file';

    /**
     *
     */
    const TYPE_LOCATION = 'location';

    /**
     * @var
     */
    private $type;

    /**
     * @var array
     */
    private $payload = [];

    /**
     * Attachment constructor.
     *
     * @param       $sender
     * @param       $type
     * @param array $payload
     *
     */
    public function __construct($sender, $type, $payload = [])
    {
        parent::__construct($sender);

        $this->type = $type;
        $this->setPayload($payload);
    }

    /**
     * Get payload
     *
     * @return array
     */
    public function getPayload()
    {
        return $this->payload;
    }

    /**
     * Set Payload
     *
     * @param array $payload
     *
     * @return $this
     */
    public function setPayload(array $payload)
    {
        $this->payload = $payload;
        return $this;
    }

    /**
     * Enable reuse
     *
     * @return $this
     */
    public function setEnableReuse()
    {
        $this->payload['is_reusable'] = true;
        return $this;
    }

    /**
     * Disable reuse
     *
     * @return $this
     */
    public function setDisableReuse()
    {
        unset($this->payload['is_reusable']);
        return $this;
    }

    /**
     * To array for send api
     *
     * @return array
     */
    public function toData()
    {
        return [
            'recipient' => [
                'id' => $this->getSender()
            ],
            'message' => [
                'attachment' => [
                    'type' => $this->type,
                    'payload' => $this->getPayload(),
                ],
            ],
        ];
    }
}