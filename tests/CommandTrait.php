<?php
use Casperlaitw\LaravelFbMessenger\Contracts\CommandHandler;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;
use Symfony\Component\Console\Application;
use Mockery as m;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * User: casperlai
 * Date: 2016/9/10
 * Time: 下午11:24
 */
trait CommandTrait
{
    private function getArtisan()
    {
        $application = new Application();
        $configMock = m::mock(Repository::class)
            ->shouldReceive('get')
            ->with('fb-messenger.app_token')
            ->andReturn(getenv('MESSENGER_APP_TOKEN'))
            ->getMock();
        $commandClass = $this->command();
        $command = new $commandClass(new CommandHandler, $configMock);
        $container = new Container();
        $command->setLaravel($container);
        $application->add($command);

        return $application;
    }

    private function createCommandTester($command)
    {
        $artisan = $this->getArtisan();
        $command = $artisan->find($command);

        return new CommandTester($command);
    }
}
