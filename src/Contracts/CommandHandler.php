<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午3:14
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Casperlaitw\LaravelFbMessenger\Messages\ReceiveMessage;
use Exception;

/**
 * Class CommandHandler
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
class CommandHandler extends BaseHandler
{
    /**
     * Handle the chatbot message
     *
     * @param ReceiveMessage $message
     *
     * @return mixed
     * @throws Exception
     */
    public function handle(ReceiveMessage $message)
    {
        throw new Exception('No Implement');
    }
}
