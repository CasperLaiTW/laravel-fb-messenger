<?php

use Casperlaitw\LaravelFbMessenger\Commands\PersistentMenuCommand;

/**
 * User: casperlai
 * Date: 2016/9/10
 * Time: 下午4:14
 */
class PersistentMenuCommandTest extends TestCase
{
    use CommandTrait;

    public function test_delete_api()
    {
        $commandTester = $this->createCommandTester('fb:menus');
        $commandTester->execute([
            '--delete' => true,
        ]);
    }

    public function test_arguments_api()
    {
        $commandTester = $this->createCommandTester('fb:menus');
        $commandTester->execute([
            '--type' => [
                'postback',
                'postback',
                'web_url',
            ],
            '--name' => [
                'Food',
                'Dessert',
                'Our website',
            ],
            '--url' => [
                'GET_FOOD_MENU',
                'GET_DESSERT_MENU',
                'https://www.facebook.com',
            ],
        ]);
    }

    public function test_empty_arguments()
    {
        $commandTester = $this->createCommandTester('fb:menus');
        $commandTester->execute([
        ], [
            'interactive' => false,
        ]);
    }

    public function test_arguments_not_compare()
    {
        $commandTester = $this->createCommandTester('fb:menus');
        $commandTester->execute([
            '--type' => [
                'postback',
                'postback',
                'web_url',
            ],
            '--name' => [
                'Food',
                'Dessert',
                'Our website',
            ],
        ]);
        $this->assertEquals('The options did not compare.', trim($commandTester->getDisplay()));
    }

    public function test_limit_types()
    {
        $commandTester = $this->createCommandTester('fb:menus');
        $commandTester->execute([
            '--type' => [
                'postback',
                'postback',
                'web_url',
                'postback',
                'postback',
                'postback',
            ],
            '--name' => [
                'Food',
                'Dessert',
                'Our website',
                'Test1',
                'Test2',
                'Test3',
            ],
            '--url' => [
                'GET_FOOD_MENU',
                'GET_DESSERT_MENU',
                'https://www.facebook.com',
                'GET_FOOD_TEST_1',
                'GET_FOOD_TEST_2',
                'GET_FOOD_TEST_3',
            ],
        ]);

        $this->assertEquals('The menu buttons is limitd to 5', trim($commandTester->getDisplay()));
    }

    public function test_button_type_error()
    {
        $commandTester = $this->createCommandTester('fb:menus');
        $commandTester->execute([
            '--type' => [
                'fail_type',
            ],
            '--name' => [
                'Food',
            ],
            '--url' => [
                'GET_FOOD_MENU',
            ],
        ]);

        $this->assertEquals('Please check type, type only postback|web_url', trim($commandTester->getDisplay()));
    }

    private function command()
    {
        return PersistentMenuCommand::class;
    }
}
