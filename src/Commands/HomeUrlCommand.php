<?php
declare(strict_types=1);

namespace Casperlaitw\LaravelFbMessenger\Commands;

use Casperlaitw\LaravelFbMessenger\Messages\HomeUrl;
use Illuminate\Support\Arr;

/**
 * Class HomeUrlCommand
 *
 * @package Casperlaitw\LaravelFbMessenger\Commands
 */
class HomeUrlCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb:home_url {--d | delete : Delete home url} '.
    '{--r | read : Read home url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set home url for chat extensions (default is add)';

    /**
     * Execute command
     *
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\NotCreateBotException
     */
    public function handle()
    {
        if ($this->option('read')) {
            $this->read();
            return;
        }

        $this->addOrRemove();
    }

    /**
     * Read domains
     */
    private function read()
    {
        $command = new HomeUrl();
        $command->setAction(HomeUrl::TYPE_READ)->useGet();
        $response = collect(Arr::get($this->handler->send($command)->getResponse(), 'data.0.home_url', []))
            ->map(function ($item) {
                return [$item];
            });

        $headers = ['Home Url'];

        $this->table($headers, $response);
    }

    /**
     *
     * @throws \Casperlaitw\LaravelFbMessenger\Exceptions\NotCreateBotException
     */
    private function addOrRemove()
    {
        $command = new HomeUrl(config('fb-messenger.home_url', []));

        if ($this->option('delete')) {
            $command->setAction(HomeUrl::TYPE_DELETE)->useDelete();
        }

        $this->comment($this->handler->send($command)->getResponse());
    }
}
