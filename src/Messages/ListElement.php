<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/9
 * Time: 上午8:43
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Exceptions\DefaultActionInvalidTypeException;

/**
 * Class ListElement
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class ListElement extends Element
{
    /**
     * @var Button
     */
    private $defaultAction;

    /**
     * ListElement constructor.
     * @param $title
     * @param $description
     * @param string $image
     */
    public function __construct($title, $description, $image)
    {
        parent::__construct($title, $description, $image, null);
    }

    /**
     * @param Button $button
     * @return $this
     * @throws DefaultActionInvalidTypeException
     */
    public function setDefaultAction(Button $button)
    {
        if ($button->getType() !== Button::TYPE_WEB) {
            throw new DefaultActionInvalidTypeException('Default action button must be `URL Button`');
        }
        $this->defaultAction = $button;

        return $this;
    }

    /**
     * To array for send api
     *
     * @return array
     */
    public function toData()
    {
        $data = parent::toData();

        if ($this->defaultAction) {
            $defaultActionData = $this->defaultAction->toData();
            unset($defaultActionData['title'], $data['item_url']);
            $data['default_action'] = $defaultActionData;
        }

        return $data;
    }
}
