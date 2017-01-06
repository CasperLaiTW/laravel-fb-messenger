<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2016/12/21
 * Time: 上午10:23
 */

namespace Casperlaitw\LaravelFbMessenger\Messages;

use Casperlaitw\LaravelFbMessenger\Contracts\Messages\Message;
use Casperlaitw\LaravelFbMessenger\Contracts\Messages\ThreadInterface;
use Casperlaitw\LaravelFbMessenger\Contracts\RequestType;

/**
 * Class DomainWhitelisting
 * @package Casperlaitw\LaravelFbMessenger\Messages
 */
class DomainWhitelisting extends Message implements ThreadInterface
{
    use RequestType;

    /**
     * Add type
     */
    const TYPE_ADD = 'add';
    /**
     * Delete type
     */
    const TYPE_DELETE = 'remove';

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
    private $domains = [];

    /**
     * DomainWhitelisting constructor.
     * @param array $domains
     */
    public function __construct($domains = [])
    {
        parent::__construct(null);
        $this->setDomains($domains);
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
     * Set domains
     *
     * @param []|string $domains
     * @return $this
     */
    public function setDomains($domains)
    {
        if (is_array($domains)) {
            foreach ($domains as $domain) {
                $this->setDomains($domain);
            }
            return $this;
        }

        $this->domains[] = $domains;

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
                'fields' => 'whitelisted_domains',
            ];
        }

        return [
            'setting_type' => 'domain_whitelisting',
            'whitelisted_domains' => $this->domains,
            'domain_action_type' => $this->action,
        ];
    }
}
