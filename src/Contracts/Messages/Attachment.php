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
     * Image type
     */
    const TYPE_IMAGE = 'image';

    /**
     * Audio type
     */
    const TYPE_AUDIO = 'audio';

    /**
     * Video type
     */
    const TYPE_VIDEO = 'video';

    /**
     * File type
     */
    const TYPE_FILE = 'file';

    /**
     * Location type
     */
    const TYPE_LOCATION = 'location';

    /**
     * Template type
     */
    const TYPE_TEMPLATE = 'template';

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
    public function enableReuse()
    {
        $this->payload['is_reusable'] = true;
        return $this;
    }

    /**
     * Disable reuse
     *
     * @return $this
     */
    public function disableReuse()
    {
        unset($this->payload['is_reusable']);
        return $this;
    }

    /**
     * Set attachment id
     *
     * @param $id
     *
     * @return $this
     */
    public function setAttachmentId($id)
    {
        $this->payload['attachment_id'] = $id;
        unset($this->payload['url'], $this->payload['is_reusable']);

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
