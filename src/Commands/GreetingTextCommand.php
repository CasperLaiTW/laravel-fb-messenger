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
    protected $signature = 'fb:greeting 
    {--G|greeting=* : The greeting text} {--L|locale=* : Locale of the greeting text. }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set facebook messenger greeting text';

    /**
     * Execute command
     */
    public function handle()
    {
        $texts = $this->option('greeting');
        $locales = $this->option('locale');

        if (count($texts) === 0) {
            $this->error('Please input greeting');
            return;
        }

        if (count($locales) === 0) {
            $greetings[] = [
                'locale' => 'default',
                'text' => $texts[0],
            ];
        } else {
            foreach ($texts as $key => $text) {
                $greetings[] = [
                    'locale' => $locales[$key],
                    'text' => $text,
                ];
            }
        }

        $greeting = new Greeting($greetings);
        $this->comment($this->handler->send($greeting)->getResponse());
    }
}
