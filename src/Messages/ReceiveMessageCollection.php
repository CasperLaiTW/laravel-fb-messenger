<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 上午2:20
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Illuminate\Support\Collection;

/**
 * Class ReceiveMessageCollection
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class ReceiveMessageCollection extends Collection
{
    /**
     * ReceiveMessageCollection constructor.
     *
     * @param array|mixed $items
     */
    public function __construct($items)
    {
        parent::__construct($items);
    }
}
