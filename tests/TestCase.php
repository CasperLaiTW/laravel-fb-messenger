<?php

use PHPUnit\Framework\TestCase as BaseTestCase;

/**
 * User: casperlai
 * Date: 2016/9/4
 * Time: 下午10:24
 */
class TestCase extends BaseTestCase
{
    protected function tearDown()
    {
        if (class_exists('Mockery')) {
            Mockery::close();
        }

        parent::tearDown();
    }

    protected function getPrivateProperty($class, $propertyName)
    {
        $reflector = new ReflectionClass($class);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);
        return $property;
    }

    protected function getPrivateMethod($class, $methodName)
    {
        $reflector = new ReflectionClass($class);
        $method = $reflector->getMethod($methodName);
        $method->setAccessible(true);
        return $method;
    }
}
