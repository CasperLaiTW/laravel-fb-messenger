<?php
use Casperlaitw\LaravelFbMessenger\Commands\GreetingTextCommand;

/**
 * User: casperlai
 * Date: 2016/9/10
 * Time: 下午11:33
 */
class GreetingTextCommandTest extends TestCase
{
    use CommandTrait;


    public function test_greeting_api()
    {
        $commandTester = $this->createCommandTester('fb:greeting');
        $commandTester->execute([
            'greeting' => 'Hello',
        ]);

        $this->assertEquals('Successfully updated greeting', trim($commandTester->getDisplay()));
    }

    private function command()
    {
        return GreetingTextCommand::class;
    }
}
