<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午3:52
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Bot;

/**
 * Class Deleteable
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
trait Deletable
{
    /**
     * @var bool
     */
    private $delete;

    /**
     * @param $value
     *
     * @return $this
     */
    public function setDelete($value)
    {
        $this->delete = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurlType()
    {
        return $this->delete ? Bot::TYPE_DELETE : Bot::TYPE_POST;
    }
}
