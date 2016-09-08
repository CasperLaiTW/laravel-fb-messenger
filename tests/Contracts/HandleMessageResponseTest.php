<?php
use Casperlaitw\LaravelFbMessenger\Contracts\HandleMessageResponse;

/**
 * User: casperlai
 * Date: 2016/9/8
 * Time: 下午9:52
 */
class HandleMessageResponseTest extends TestCase
{
    public function test_get_error()
    {
        $response = [
            'result' => 'error',
            'error' => [
                'message' => 'Occur error'
            ],
        ];

        $handler = new HandleMessageResponse($response);

        $this->assertEquals('Occur error', $handler->getResponse());
    }

    public function test_get_response()
    {
        $response = [
            'result' => 'Pass'
        ];
        $handler = new HandleMessageResponse($response);

        $this->assertEquals('Pass', $handler->getResponse());
    }
}
