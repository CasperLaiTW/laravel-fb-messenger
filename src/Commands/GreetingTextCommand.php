<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午3:07
 */

namespace Casperlaitw\LaravelFbMessenger\Commands;

use Casperlaitw\LaravelFbMessenger\Contracts\CommandHandler;
use Casperlaitw\LaravelFbMessenger\Messages\Greeting;
use Illuminate\Console\Command;

/**
 * Class SetGreetingTextCommand
 * @package Casperlaitw\LaravelFbMessenger\Commands
 */
class GreetingTextCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb:greeting {greeting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set facebook messenger greeting text';

    /**
     *
     */
    public function handle()
    {
        $text = $this->argument('greeting');
        $handler = new CommandHandler;
        $greeting = new Greeting($text);

        $this->comment($handler->send($greeting)->getResponse());
    }
}
