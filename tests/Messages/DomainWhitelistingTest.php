<?php
/**
 * Created by PhpStorm.
 * User: casperlai
 * Date: 2017/1/7
 * Time: 上午4:10
 */

use Casperlaitw\LaravelFbMessenger\Messages\DomainWhitelisting;

class DomainWhitelistingTest extends \PHPUnit_Framework_TestCase
{
    public function test_read_domains_to_data()
    {
        $domains = [];

        $message = new DomainWhitelisting();
        $message->setAction(DomainWhitelisting::TYPE_READ);

        $this->assertArraySubset(['fields' => 'whitelisted_domains'], $message->toData());
    }

    public function test_delete_domains_to_data()
    {
        $domains = ['https://example.com'];

        $message = new DomainWhitelisting($domains);
        $message->setAction(DomainWhitelisting::TYPE_DELETE);

        $this->assertArraySubset([
            'fields' => [
                'whitelisted_domains',
            ],
        ], $message->toData());
    }

    public function test_add_domains_to_data()
    {
        $domains = ['https://example.com'];

        $message = new DomainWhitelisting($domains);

        $this->assertArraySubset([
            'whitelisted_domains' => [
                'https://example.com',
            ],
        ], $message->toData());
    }
}
