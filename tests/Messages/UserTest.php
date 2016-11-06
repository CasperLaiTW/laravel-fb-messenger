<?php
use Casperlaitw\LaravelFbMessenger\Messages\User;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/11/6
 * Time: 下午1:46
 */

class UserTest extends TestCase
{
    public function test_to_data()
    {
        $sender = str_random();
        $user = new User($sender);

        $this->assertEquals([], $user->toData());
    }
}
