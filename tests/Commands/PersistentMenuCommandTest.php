<?php

use Casperlaitw\LaravelFbMessenger\Commands\PersistentMenuCommand;
use Casperlaitw\LaravelFbMessenger\Facades\MessengerMenu;
use Illuminate\Container\Container;
use Mockery as m;

/**
 * User: casperlai
 * Date: 2016/9/10
 * Time: 下午4:14
 */
class PersistentMenuCommandTest extends TestCase
{
    use CommandTrait {
        CommandTrait::getArtisan as getParentArtisan;
    }

    public function getArtisan()
    {
        $menu = $this->mockMenu();
        $container = new Container();

        $container->singleton(MessengerMenu::class, function () use ($menu) {
            return $menu;
        });
        return $this->getParentArtisan($container);
    }

    public function test_delete_api()
    {
        $commandTester = $this->createCommandTester('fb:menus');
        $commandTester->execute([
            '--delete' => true,
        ]);
    }
    
    public function test_setting_api()
    {
        $commandTester = $this->createCommandTester('fb:menus');
        $commandTester->execute([]);
    }

    public function test_read_api()
    {
        $commandTester = $this->createCommandTester('fb:menus');
        $commandTester->execute([
            '--read' => true,
        ]);
    }

    private function command()
    {
        return PersistentMenuCommand::class;
    }

    protected function mockMenu()
    {
        $mock = MessengerMenu::shouldReceive('getMenus')
            ->andReturn([])
            ->shouldReceive('isEmpty')
            ->andReturn(true)
            ->getMock();
        
        return $mock;
    }
}
