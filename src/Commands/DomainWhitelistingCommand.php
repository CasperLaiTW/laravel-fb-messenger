<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/12/21
 * Time: 上午10:17
 */

namespace Casperlaitw\LaravelFbMessenger\Commands;

use Casperlaitw\LaravelFbMessenger\Messages\DomainWhitelisting;
use Illuminate\Support\Arr;

/**
 * Class DomainWhitelistingCommand
 * @package Casperlaitw\LaravelFbMessenger\Commands
 */
class DomainWhitelistingCommand extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fb:whitelisting {--domain=* : Your domain url} {--d | delete : Delete all domain whitelisting} '.
        '{--r | read : Read domain whitelisting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set facebook messenger domain whitelisting';

    /**
     * Execute command
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
        $command = new DomainWhitelisting();
        $command->setAction(DomainWhitelisting::TYPE_READ)->useGet();
        $response = collect(Arr::get($this->handler->send($command)->getResponse(), 'data.0.whitelisted_domains', []))
            ->map(function ($item) {
                return [$item];
            });

        $headers = ['Domains'];

        $this->table($headers, $response);
    }

    /**
     *
     */
    private function addOrRemove()
    {
        $domains = $this->option('domain');

        if (count($domains) > 10) {
            $this->error('Domains max: 10 items');
            return;
        }

        $command = new DomainWhitelisting($domains);

        if ($this->option('delete')) {
            $command->setAction(DomainWhitelisting::TYPE_DELETE)->useDelete();
        }

        $this->comment($this->handler->send($command)->getResponse());
    }
}
