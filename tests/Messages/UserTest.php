<?php
use Casperlaitw\LaravelFbMessenger\Messages\User;
use Illuminate\Support\Str;

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
        $sender = Str::random();
        $user = new User($sender);

        $this->assertEquals([], $user->toData());
    }
}
