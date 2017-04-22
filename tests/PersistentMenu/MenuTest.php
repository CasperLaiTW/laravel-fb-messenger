<?php

use Casperlaitw\LaravelFbMessenger\PersistentMenu\Menu;

class MenuTest extends TestCase
{
    public function test_is_empty()
    {
        $this->assertEquals(true, (new Menu())->isEmpty());
    }
}
