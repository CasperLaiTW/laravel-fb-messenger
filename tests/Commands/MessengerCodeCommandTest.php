<?php

use Casperlaitw\LaravelFbMessenger\Commands\MessengerCodeCommand;

class MessengerCodeCommandTest extends TestCase
{
    use CommandTrait;

    public function test_send_api()
    {
        $commandTester = $this->createCommandTester('fb:code');
        $commandTester->execute([
            '--size' => 2000,
            '--ref' => 'test-on-set-ref',
        ]);
    }

    private function command()
    {
        return MessengerCodeCommand::class;
    }
}
