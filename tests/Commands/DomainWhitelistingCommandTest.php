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

    public function test_over_ten_domains()
    {
        $commandTester = $this->createCommandTester('fb:whitelisting');
        $commandTester->execute([
            '--domain' => [
                'https://example.com',
                'https://example2.com',
                'https://example3.com',
                'https://example4.com',
                'https://example5.com',
                'https://example6.com',
                'https://example7.com',
                'https://example8.com',
                'https://example9.com',
                'https://example10.com',
                'https://example11.com',
            ],
        ]);

        $this->assertEquals('Domains max: 10 items'.PHP_EOL, $commandTester->getDisplay());
    }

    private function command()
    {
        return DomainWhitelistingCommand::class;
    }
}
