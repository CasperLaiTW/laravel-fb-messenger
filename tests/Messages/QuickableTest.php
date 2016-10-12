<?php
use Casperlaitw\LaravelFbMessenger\Messages\Quickable;
use Casperlaitw\LaravelFbMessenger\Messages\QuickReply;

/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/10/13
 * Time: 上午1:12
 */
class QuickableTest extends TestCase
{
    public function test_add_quick()
    {
        $stub = new QuickStub();
        $stub->bootQuick();

        $title = 'Red';
        $payload = 'PAYLOAD_RED';

        $stub->addQuick(new QuickReply($title, $payload));

        $expected = [
          'message' => [
              'quick_replies' => [
                  [
                      'content_type' => 'text',
                      'title' => $title,
                      'payload' => $payload,
                  ],
              ],
          ],
        ];

        $this->assertEquals($expected, $stub->makeQuickReply());
    }
}

class QuickStub
{
    use Quickable;
}
