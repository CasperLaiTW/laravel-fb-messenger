<?php

namespace Casperlaitw\LaravelFbMessenger\Commands;

use Casperlaitw\LaravelFbMessenger\Messages\MessengerCode;
use Illuminate\Support\Arr;

class MessengerCodeCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb:code {--s|size : Image size} {--r|ref : Ref}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set messenger code';

    /**
     * Execute command
     */
    public function handle()
    {
        $message = new MessengerCode();

        if ($size = $this->option('size')) {
            $message->setImageSize($size);
        }

        if ($ref = $this->option('ref')) {
            $message->setRef($ref);
        }

        $this->comment(Arr::get($this->handler->send($message), 'uri'));
    }
}
