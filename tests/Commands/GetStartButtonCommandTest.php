<?php
use Casperlaitw\LaravelFbMessenger\Commands\GetStartButtonCommand;

/**
 * User: casperlai
 * Date: 2016/9/10
 * Time: 下午11:36
 */
class GetStartButtonCommandTest extends TestCase
{
    use CommandTrait;

    public function test_set_get_start_api()
    {
        $commandTester = $this->createCommandTester('fb:get-start');
        $commandTester->execute([
            'payload' => 'GET_START',
        ]);
    }

    public function test_delete_get_start_api()
    {
        $commandTester = $this->createCommandTester('fb:get-start');
        $commandTester->execute([
            '--delete' => true,
        ]);
    }

    public function test_empty_payload()
    {
        $commandTester = $this->createCommandTester('fb:get-start');
        $commandTester->execute([
        ]);
    }

    private function command()
    {
        return GetStartButtonCommand::class;
    }
}
