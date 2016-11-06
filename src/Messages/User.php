<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/6
 * Time: 下午1:28
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\UserInterface;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;

class User extends Message implements UserInterface
{
    /**
     * To array for send api
     * @return array
     */
    public function toData()
    {
        return [];
    }
}
