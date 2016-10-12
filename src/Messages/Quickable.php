<?php
/**
 * User: casperlai
 * Date: 2016/9/18
 * Time: 下午10:04
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Collections\QuickReplyCollection;

/**
 * Class Quickable
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
trait Quickable
{
    /**
     * @var QuickReplyCollection
     */
    protected $quicks;

    /**
     * Boot quick
     */
    public function bootQuick()
    {
        $this->quicks = new QuickReplyCollection();
    }

    /**
     * @param $quick
     *
     * @return $this
     */
    public function addQuick($quick)
    {
        $this->quicks->add($quick);

        return $this;
    }

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return $this->quicks->isEmpty();
    }

    /**
     * @param $data
     *
     * @return array
     */
    public function makeQuickReply($data = [])
    {
        if (!$this->isEmpty()) {
            $data['message']['quick_replies'] = $this->quicks->toData();
        }

        return $data;
    }
}
