<?php
use Casperlaitw\LaravelFbMessenger\Commands\DomainWhitelistingCommand;

class DomainWhitelistingCommandTest extends TestCase
{
    use CommandTrait;

    public function test_add_domains()
    {
        $commandTester = $this->createCommandTester('fb:whitelisting');
        $commandTester->execute([
            '--domain' => [
                'https://example.com',
                'https://example2.com',
            ],
        ]);
    }

    public function test_read_domains()
    {
        $commandTester = $this->createCommandTester('fb:whitelisting');
        $commandTester->execute([
            '--read' => true
        ]);
    }

    public function test_delete_domains()
    {
        $commandTester = $this->createCommandTester('fb:whitelisting');
        $commandTester->execute([
            '--domain' => 'https://example.com',
            '--delete' => true,
        ]);
    }

    private function command()
    {
        return DomainWhitelistingCommand::class;
    }
}
