<?php
use Casperlaitw\LaravelFbMessenger\Contracts\CommandHandler;
use Casperlaitw\LaravelFbMessenger\Contracts\HandleMessageResponse;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository;
use Mockery as m;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * User: casperlai
 * Date: 2016/9/10
 * Time: 下午11:24
 */
trait CommandTrait
{
    protected function getArtisan($container = null)
    {
        $application = new Application();
        $configMock = m::mock(Repository::class)
            ->shouldReceive('get')
            ->with('fb-messenger.app_token')
            ->andReturn(getenv('MESSENGER_APP_TOKEN'))
            ->shouldReceive('get')
            ->with('fb-messenger.app_secret')
            ->andReturn(getenv('MESSENGER_APP_SECRET'))
            ->getMock();

        $response = m::mock(HandleMessageResponse::class)->makePartial();
        $handler = m::mock(CommandHandler::class.'[send]');
        $handler
            ->shouldReceive('send')
            ->andReturn($response);

        $commandClass = $this->command();
        $command = new $commandClass($handler, $configMock);
        $command->setLaravel($container);
        $application->add($command);

        return $application;
    }

    private function createCommandTester($command)
    {
        $artisan = $this->getArtisan(new Container());
        $command = $artisan->find($command);

        return new CommandTester($command);
    }
}
