<?php

use Casperlaitw\LaravelFbMessenger\Facades\MessengerMenu;
use Casperlaitw\LaravelFbMessenger\Messages\PersistentMenuMessage;
use Casperlaitw\LaravelFbMessenger\PersistentMenu\Menu;
use Illuminate\Container\Container;

/**
 * User: casperlai
 * Date: 2016/9/4
 * Time: 上午12:32
 */
class PersistentMenuMessageTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
    }


    public function test_to_data()
    {
        $menu = $this->getMenu();
        require __DIR__ . '/../stub/menu.php';
        $persistent = new PersistentMenuMessage($menu->getMenus());
        $expected = [
            'persistent_menu' => [
                [
                    'locale' => 'default',
                    'call_to_actions' => [
                        [
                            'type' => 'postback',
                            'title' => 'Test Button',
                            'payload' => 'TEST_POSTBACK',
                        ],
                        [
                            'type' => 'web_url',
                            'title' => 'WebUrl',
                            'url' => 'https://github.com/CasperLaiTW/laravel-fb-messenger',
                        ],
                        [
                            'title' => 'SubMenu',
                            'type' => 'nested',
                            'call_to_actions' => [
                                [
                                    'type' => 'postback',
                                    'title' => 'SubMenu-Button',
                                    'payload' => 'TEST_SUB_BUTTON',
                                ],
                                [
                                    'type' => 'web_url',
                                    'title' => 'SubMenu-WebUrl',
                                    'url' => 'https://github.com/CasperLaiTW/laravel-fb-messenger',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'locale' => 'zh_TW',
                    'composer_input_disabled' => true,
                    'call_to_actions' => [
                        [
                            'type' => 'postback',
                            'title' => 'zh_TW Test Button',
                            'payload' => 'TEST_POSTBACK',
                        ],
                        [
                            'type' => 'postback',
                            'title' => 'zh_TW Test Button',
                            'payload' => 'TEST_POSTBACK',
                        ],
                        [
                            'type' => 'postback',
                            'title' => 'zh_TW Test Button',
                            'payload' => 'TEST_POSTBACK',
                        ],
                    ],
                ],
            ],
        ];
        $this->assertEquals($expected, $persistent->toData());
    }

    /**
     * @return Menu
     */
    protected function getMenu()
    {
        $container = new Container();

        $menu = new Menu();

        $container->singleton(Menu::class, function () use ($menu) {
            return $menu;
        });

        return $menu;
    }
}
