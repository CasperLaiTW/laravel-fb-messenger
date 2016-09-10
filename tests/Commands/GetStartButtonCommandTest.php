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

        $this->assertEquals('Successfully added new_thread\'s CTAs', trim($commandTester->getDisplay()));
    }

    public function test_delete_get_start_api()
    {
        $commandTester = $this->createCommandTester('fb:get-start');
        $commandTester->execute([
            '--delete' => true,
        ]);

        $this->assertEquals('Successfully deleted all new_thread\'s CTAs', trim($commandTester->getDisplay()));
    }

    public function test_empty_payload()
    {
        $commandTester = $this->createCommandTester('fb:get-start');
        $commandTester->execute([
        ]);

        $this->assertEquals('If you want to add start button, please input the payload', trim($commandTester->getDisplay()));
    }

    private function command()
    {
        return GetStartButtonCommand::class;
    }
}
