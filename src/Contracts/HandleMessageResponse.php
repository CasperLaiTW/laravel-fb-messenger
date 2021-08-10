<?php
/**
 * User: casperlai
 * Date: 2016/9/2
 * Time: 下午9:44.
 */

namespace Casperlaitw\LaravelFbMessenger\Contracts;

use Illuminate\Support\Arr;

/**
 * Class HandleMessageResponse
 * @package Casperlaitw\LaravelFbMessenger\Contracts
 */
class HandleMessageResponse
{
    /**
     * @var string
     */
    protected $response;

    /**
     * HandleMessageResponse constructor.
     *
     * @param $response
     */
    public function __construct($response)
    {
        $this->response = $response;
    }

    /**
     * Get API response message
     * @return string
     */
    public function getResponse()
    {
        if (!empty($this->response['error'])) {
            return $this->handleError($this->response['error']);
        }
        return Arr::get($this->response, 'result', $this->response);
    }

    /**
     * Get error message
     * @param $error
     *
     * @return string
     */
    private function handleError($error)
    {
        return $error['message'];
    }
}
