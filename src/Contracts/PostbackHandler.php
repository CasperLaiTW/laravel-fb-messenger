<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 下午3:29
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

/**
 * Class PostbackHandler
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
abstract class PostbackHandler extends BaseHandler
{
    /**
     * @var string
     */
    protected $payload;

    /**
     * Get payload
     *
     * @return mixed
     */
    public function getPayload()
    {
        return $this->payload;
    }
}
