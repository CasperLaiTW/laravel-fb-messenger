<?php
/**
 * User: casperlai
 * Date: 2016/9/1
 * Time: 上午4:06
 */

namespace Casperlaitw\LaravelFbMessenger\Commands;

use Casperlaitw\LaravelFbMessenger\Messages\StartButton;

/**
 * Class GetStartButtonCommand
 * @package Casperlaitw\LaravelFbMessenger\Commands
 */
class GetStartButtonCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb:get-start {payload?} {--d | delete : delete the start button}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set start button';

    /**
     * Execute command
     */
    public function handle()
    {
        $payload = $this->argument('payload');
        $deleteOption = $this->option('delete');
        if (!$deleteOption && empty($payload)) {
            $this->error('If you want to add start button, please input the payload');
            return;
        }

        $startButton = new StartButton($payload);
        if ($deleteOption) {
            $startButton->useDelete();
        }

        $this->comment($this->handler->send($startButton)->getResponse());
    }
}
