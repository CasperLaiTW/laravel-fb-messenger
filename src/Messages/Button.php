<?php
/**
 * User: casperlai
 * Date: 2016/9/16
 * Time: 上午12:19
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\MessageInterface;
use Casperlaitw\LaravelFbMessenger\Exceptions\UnknownTypeException;

/**
 * Class Button
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class Button implements MessageInterface
{
    /**
     * Web url button type
     */
    const TYPE_WEB = 'web_url';

    /**
     * Postback button type
     */
    const TYPE_POSTBACK = 'postback';

    /**
     * Phone call button type
     */
    const TYPE_CALL = 'phone_number';

    /**
     * Share button type
     */
    const TYPE_SHARE = 'element_share';

    /**
     * Account link
     */
    const TYPE_ACCOUNT_LINK = 'account_link';

    /**
     * Button type
     * @var string
     */
    private $type;

    /**
     * Button title
     * @var string
     */
    private $title;

    /**
     * Button postback or web url
     * @var string
     */
    private $payload;

    /**
     * Button extra property
     * @var array
     */
    private $extra = [];

    /**
     * Button constructor.
     *
     * @param $type
     * @param $title
     * @param $payload
     */
    public function __construct($type, $title, $payload = '')
    {
        $this->type = $type;
        $this->title = $title;
        $this->payload = empty($payload) ? $title : $payload;
    }

    /**
     * To array for send api
     *
     * @return array
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\UnknownTypeException
     */
    public function toData()
    {
        switch ($this->type) {
            case self::TYPE_SHARE:
                return [
                    'type' => $this->type,
                ];
            case self::TYPE_ACCOUNT_LINK:
                return [
                    'type' => $this->type,
                    'url' => $this->payload,
                ];
            default:
                return [
                    'type' => $this->type,
                    'title' => $this->title,
                ] + $this->makePayload();
        }
    }

    /**
     * Make payload by type
     *
     * @return array
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\UnknownTypeException
     */
    private function makePayload()
    {
        $payload = [];
        switch ($this->type) {
            case self::TYPE_POSTBACK:
            case self::TYPE_CALL:
                $payload = ['payload' => $this->payload];
                break;
            case self::TYPE_WEB:
                $payload = ['url' => $this->payload];
                break;
            default:
                throw new UnknownTypeException;
        }

        return array_merge($payload, $this->extra);
    }

    /**
     * Get button type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set button extra
     *
     * @param array $value
     *
     * @return $this
     */
    public function setExtra(array $value)
    {
        $this->extra = $value;

        return $this;
    }
}
