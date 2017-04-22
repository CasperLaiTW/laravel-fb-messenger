<?php
/**
 * User: casperlai
 * Date: 2016/9/2
 * Time: 下午5:47
 */

namespace Casperlaitw\LaravelFbMessenger\Commands;

use Casperlaitw\LaravelFbMessenger\Contracts\Bot;
use Casperlaitw\LaravelFbMessenger\Contracts\CommandHandler;
use Casperlaitw\LaravelFbMessenger\Facades\MessengerMenu;
use Casperlaitw\LaravelFbMessenger\Messages\PersistentMenuMessage;
use Casperlaitw\LaravelFbMessenger\PersistentMenu\Menu;
use Illuminate\Contracts\Config\Repository;

/**
 * Class PersistentMenuCommand
 * @package Casperlaitw\LaravelFbMessenger\Commands
 */
class PersistentMenuCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb:menus {--d | delete : Delete the menus} {--r | read : Delete the menus}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set menus';


    /**
     * Execute command
     */
    public function handle()
    {
        $persistentMenuMessage = new PersistentMenuMessage(MessengerMenu::getMenus());

        if ($this->option('delete')) {
            $persistentMenuMessage->useDelete();
        }

        if ($this->option('read')) {
            $persistentMenuMessage->useGet();
        }

        if ($persistentMenuMessage->getCurlType() === Bot::TYPE_POST && MessengerMenu::isEmpty()) {
            $this->warn('Menu tree is empty.');
            return;
        }

        $response = $this->handler->send($persistentMenuMessage)->getResponse();

        $this->comment($this->option('read') ? json_encode($response) : $response);
    }
}
