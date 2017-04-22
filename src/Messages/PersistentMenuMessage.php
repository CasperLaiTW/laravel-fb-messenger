<?php
/**
 * User: casperlai
 * Date: 2016/9/2
 * Time: 下午9:34
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Bot;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\ProfileInterface;
use Casperlaitw\LaravelFbMessenger\Contracts\RequestType;

/**
 * Class PersistentMenuMessage
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class PersistentMenuMessage extends Message implements ProfileInterface
{
    use RequestType;

    /**
     * @var array
     */
    private $menus;

    /**
     * PersistentMenuMessage constructor.
     *
     * @param $menus
     */
    public function __construct($menus = [])
    {
        parent::__construct(null);
        $this->menus = $menus;
    }

    /**
     * Message to send
     * @return array
     */
    public function toData()
    {
        if ($this->type === Bot::TYPE_DELETE) {
            return [
                'fields' => [
                    'persistent_menu',
                ],
            ];
        }

        if ($this->type === Bot::TYPE_GET) {
            return [
                'fields' => 'persistent_menu',
            ];
        }

        return [
            'persistent_menu' => $this->menus,
        ];
    }
}
