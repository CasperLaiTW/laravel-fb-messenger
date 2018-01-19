<?php
declare(strict_types=1);

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\ProfileInterface;
use Casperlaitw\LaravelFbMessenger\Contracts\RequestType;

class HomeUrl extends Message implements ProfileInterface
{
    use RequestType;

    /**
     * Add type
     */
    const TYPE_ADD = 'add';
    /**
     * Delete type
     */
    const TYPE_DELETE = 'delete';

    /**
     * Read type
     */
    const TYPE_READ = 'read';

    /**
     * @var string
     */
    private $action = self::TYPE_ADD;

    /**
     * @var array
     */
    private $config;

    /**
     * HomeUrl constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        parent::__construct(null);
        $this->config = $config;
    }


    /**
     * Set domain whitelisting action
     *
     * @param $action
     * @return $this
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * To array for send api
     * @return array
     */
    public function toData()
    {
        if ($this->action === self::TYPE_READ) {
            return [
                'fields' => 'home_url',
            ];
        }

        if ($this->action === self::TYPE_DELETE) {
            return [
                'fields' => [
                    'home_url',
                ],
            ];
        }

        return [
            'home_url' => array_merge([
                'webview_height_ratio' => 'tall',
            ], $this->config),
        ];
    }
}
