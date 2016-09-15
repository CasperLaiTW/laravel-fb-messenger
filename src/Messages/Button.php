<?php
/**
 * User: casperlai
 * Date: 2016/9/16
 * Time: 上午12:19
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\MessageInterface;

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
     */
    public function toData()
    {
        return [
            'type' => $this->type,
            'title' => $this->title,
        ] + $this->makePayload();
    }

    /**
     * Make payload by type
     *
     * @return array
     */
    private function makePayload()
    {
        $payload = [];
        switch ($this->type)
        {
            case self::TYPE_POSTBACK:
            case self::TYPE_CALL:
                $payload = ['payload' => $this->payload];
                break;
            case self::TYPE_WEB:
                $payload = ['url' => $this->payload];
                break;
            case self::TYPE_SHARE:
            default:
                break;
        }

        return $payload;
    }
}
