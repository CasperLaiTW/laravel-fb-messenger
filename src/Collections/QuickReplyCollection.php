<?php
/**
 * User: casperlai
 * Date: 2016/9/18
 * Time: 下午10:03
 */

namespace Casperlaitw\LaravelFbMessenger\Collections;

use Casperlaitw\LaravelFbMessenger\Exceptions\ValidatorStructureException;
use Casperlaitw\LaravelFbMessenger\Messages\QuickReply;

/**
 * Class QuickReplyCollection
 * @package Casperlaitw\LaravelFbMessenger\Collections
 */
class QuickReplyCollection extends BaseCollection
{
    /**
     * @return bool
     */
    public function isEmpty()
    {
        return !count($this->getElements()) > 0;
    }

    /**
     * Validate collection item
     *
     * @param $element
     *
     * @return bool
     * @throws ValidatorStructureException
     */
    public function validator($element)
    {
        if (!$element instanceof QuickReply) {
            throw new ValidatorStructureException(
                'The `element` object should be instance of `\Casperlaitw\LaravelFbMessenger\Messages\QuickReply`'
            );
        }

        return true;
    }
}
