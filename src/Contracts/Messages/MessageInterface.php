<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午2:38
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts\Messages;

/**
 * Interface MessageInterface
 * @package Casperlaitw\LaravelFbMessenger\Contracts\Messages
 */
interface MessageInterface
{
    /**
     * To array for send api
     * @return array
     */
    public function toData();
}
