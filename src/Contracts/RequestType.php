<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2017/1/7
 * Time: 上午3:07
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

/**
 * Class RequestType
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
trait RequestType
{
    /**
     * Request type
     *
     * @var string
     */
    private $type = Bot::TYPE_POST;

    /**
     * Use post type
     *
     * @return $this
     */
    public function usePost()
    {
        $this->type = Bot::TYPE_POST;

        return $this;
    }

    /**
     * Use get type
     *
     * @return $this
     */
    public function useGet()
    {
        $this->type = Bot::TYPE_GET;

        return $this;
    }

    /**
     * Use delete type
     *
     * @return $this
     */
    public function useDelete()
    {
        $this->type = Bot::TYPE_DELETE;

        return $this;
    }

    /**
     * Get request type
     *
     * @return string
     */
    public function getCurlType()
    {
        return $this->type;
    }
}
