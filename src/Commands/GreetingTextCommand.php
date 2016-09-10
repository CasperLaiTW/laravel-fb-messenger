<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午3:07
 */

namespace Casperlaitw\LaravelFbMessenger\Commands;

use Casperlaitw\LaravelFbMessenger\Messages\Greeting;

/**
 * Class SetGreetingTextCommand
 * @package Casperlaitw\LaravelFbMessenger\Commands
 */
class GreetingTextCommand extends BaseCommand
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
        $greeting = new Greeting($text);

        $this->comment($this->handler->send($greeting)->getResponse());
    }
}
