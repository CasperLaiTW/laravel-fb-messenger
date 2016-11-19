<?php
/**
 * User: casperlai
 * Date: 2016/9/18
 * Time: 下午9:56
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;

/**
 * Class QuickReply
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class QuickReply extends Message
{
    /**
     * Text type
     */
    const TYPE_TEXT = 'text';

    /**
     * Location type
     */
    const TYPE_LOCATION = 'location';

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $payload;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $imageUrl;

    /**
     * QuickReply constructor.
     *
     * @param $title
     * @param $payload
     */
    public function __construct($title, $payload)
    {
        parent::__construct(null);
        $this->title = $title;
        $this->payload = $payload;
        $this->type = self::TYPE_TEXT;
    }

    /**
     * Set location quick reply
     *
     * @return $this
     */
    public function setLocation()
    {
        $this->type = self::TYPE_LOCATION;

        return $this;
    }

    /**
     * Set image url
     *
     * @param $image
     *
     * @return $this
     */
    public function setImage($image)
    {
        $this->imageUrl = $image;

        return $this;
    }

    /**
     * To array for send api
     * @return array
     */
    public function toData()
    {
        if ($this->type === self::TYPE_LOCATION) {
            return ['content_type' => 'location'];
        }

        return array_merge([
            'content_type' => 'text',
            'title' => $this->title,
            'payload' => $this->payload,
        ], $this->imageUrl ? ['image_url' => $this->imageUrl] : []);
    }
}
