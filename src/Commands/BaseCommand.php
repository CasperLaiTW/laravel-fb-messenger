<?php
/**
 * User: casperlai
 * Date: 2016/9/10
 * Time: 下午11:30
 */

namespace Casperlaitw\LaravelFbMessenger\Commands;

use Casperlaitw\LaravelFbMessenger\Contracts\CommandHandler;
use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;

/**
 * Class BaseCommand
 * @package Casperlaitw\LaravelFbMessenger\Commands
 */
abstract class BaseCommand extends Command
{
    /**
     * @var CommandHandler
     */
    protected $handler;

    /**
     * BaseCommand constructor.
     *
     * @param CommandHandler $handler
     * @param Repository     $config
     */
    public function __construct(CommandHandler $handler, Repository $config)
    {
        parent::__construct();
        $this->handler = $handler->createBot(
            $config->get('fb-messenger.app_token'),
            $config->get('fb-messenger.app_secret')
        );
    }
}
