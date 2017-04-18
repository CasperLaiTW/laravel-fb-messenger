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
            '--locale' => ['default', 'zh_TW'],
            '--greeting' => ['Hi', 'Hi, zh_TW'],
        ]);
    }

    public function test_empty_greeting()
    {
        $commandTester = $this->createCommandTester('fb:greeting');
        $commandTester->execute([]);

        $this->assertEquals('Please input greeting'.PHP_EOL, $commandTester->getDisplay());
    }

    public function test_default_greeting()
    {
        $commandTester = $this->createCommandTester('fb:greeting');
        $commandTester->execute([
            '--greeting' => ['Hi'],
        ]);
    }

    private function command()
    {
        return GreetingTextCommand::class;
    }
}
