<?php
/**
 * User: casperlai
 * Date: 2016/8/31
 * Time: 下午3:41
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts\Messages;

use Casperlaitw\LaravelFbMessenger\Collections\BaseCollection;
use Casperlaitw\LaravelFbMessenger\Messages\Quickable;
use Illuminate\Container\Container;

/**
 * Class Structured
 * @package Casperlaitw\LaravelFbMessenger\Contracts\Messages
 */
abstract class Template extends Attachment
{
    use Quickable;

    /**
     * @var BaseCollection
     */
    protected $collections;

    /**
     * User can use native share
     *
     * @var bool
     */
    private $share = true;

    /**
     * Structured constructor.
     *
     * @param $sender
     */
    public function __construct($sender)
    {
        parent::__construct($sender, self::TYPE_TEMPLATE);
        $app = new Container();
        $this->collections = $app->make($this->collection());
        $this->bootQuick();
    }


    /**
     * Add elements
     * @param $elements
     *
     * @return $this
     */
    public function add($elements)
    {
        if (is_array($elements)) {
            foreach ($elements as $element) {
                $this->add($element);
            }
        } else {
            $this->collections->add($elements);
        }

        return $this;
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (method_exists($this->collections, $name)) {
            return call_user_func_array([$this->collections, $name], $arguments);
        }
    }

    /**
     * Get collection
     *
     * @return BaseCollection
     */
    public function getCollections()
    {
        return $this->collections;
    }

    /**
     * To array for send api
     *
     * @return array
     */
    public function toData()
    {
        if (!$this->share) {
            $this->setPayload(array_merge($this->getPayload(), [
                'sharable' => false,
            ]));
        }
        return $this->makeQuickReply(parent::toData());
    }

    /**
     * Disable share
     *
     * @return $this
     */
    public function disableShare()
    {
        $this->share = false;

        return $this;
    }

    /**
     * Collection class name
     *
     * @return mixed
     */
    abstract protected function collection();
}
