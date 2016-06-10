<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common\Tests;

use InvalidArgumentException;
use ReflectionProperty;
use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\Common\Mock\MockClient;
use SellerWorks\Amazon\MWS\Common\ClientInterface;

/**
 * MockClient tests.  Testing only the "abstract" parts of the AbstractClient class.
 */
class MockClientTest extends TestCase
{
    /**
     * Test setCountry method for valid values.
     */
    public function test_setCountry()
    {
        $client = new MockClient();
        $reflection = new ReflectionProperty($client, 'host');
        $reflection->setAccessible(true);

        $countryInfo = [
            // NA Region
            ClientInterface::COUNTRY_CA => 'mws.amazonservices.ca',
            ClientInterface::COUNTRY_MX => 'mws.amazonservices.com.mx',
            ClientInterface::COUNTRY_US => 'mws.amazonservices.com',

            // EU Region
            ClientInterface::COUNTRY_DE => 'mws-eu.amazonservices.com',
            ClientInterface::COUNTRY_ES => 'mws-eu.amazonservices.com',
            ClientInterface::COUNTRY_FR => 'mws-eu.amazonservices.com',
            ClientInterface::COUNTRY_IN => 'mws.amazonservices.in',
            ClientInterface::COUNTRY_IT => 'mws-eu.amazonservices.com',
            ClientInterface::COUNTRY_UK => 'mws-eu.amazonservices.com',

            // FE Region
            ClientInterface::COUNTRY_JP => 'mws.amazonservices.jp',

            // CN Region
            ClientInterface::COUNTRY_CN => 'mws.amazonservices.com.cn',
        ];

        // Check values.
        foreach ($countryInfo as $country => $host) {
            $client->setCountry($country);
            $this->assertEquals($host, $reflection->getValue($client));
        }
    }

    /**
     * Test setCountry method for invalid value.
     */
    public function test_setCountryException()
    {
        $this->expectException(InvalidArgumentException::class);

        $client = new MockClient();
        $client->setCountry('INVALID');
    }
}