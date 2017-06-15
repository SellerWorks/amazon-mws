<?php

namespace SellerWorks\Amazon\Tests\Credentials;

use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\Credentials\Credentials;

/**
 * Serializer tests
 */
class CredentialsTest extends TestCase
{
    const SELLER_ID      = '613cc6e5-3398-41b0-a38a-d33e9eb47989';
    const ACCESS_KEY     = '1f7495c9-9f10-491b-8430-29a8be1a3a0b';
    const SECRET_KEY     = '05b6d5df-741d-451e-95f2-88c3e7698858';
    const MWS_AUTH_TOKEN = '24fc49a2-9226-44bc-92c9-fa7cf6b3be6d';

    /**
     * @covers SellerWorks\Amazon\Credentials\Credentials::__construct
     * @covers SellerWorks\Amazon\Credentials\Credentials::getSellerId
     * @covers SellerWorks\Amazon\Credentials\Credentials::getAccessKey
     * @covers SellerWorks\Amazon\Credentials\Credentials::getSecretKey
     * @covers SellerWorks\Amazon\Credentials\Credentials::getMwsAuthToken
     */
    public function testConstruct()
    {
        // Without MwsAuthToken
        $credentials = new Credentials(self::SELLER_ID, self::ACCESS_KEY, self::SECRET_KEY);

        $this->assertSame(self::SELLER_ID,  $credentials->getSellerId());
        $this->assertSame(self::ACCESS_KEY, $credentials->getAccessKey());
        $this->assertSame(self::SECRET_KEY, $credentials->getSecretKey());
        $this->assertEmpty($credentials->getMwsAuthToken());


        // With MwsAuthToken
        $credentials = new Credentials(self::SELLER_ID, self::ACCESS_KEY, self::SECRET_KEY, self::MWS_AUTH_TOKEN);

        $this->assertSame(self::SELLER_ID,      $credentials->getSellerId());
        $this->assertSame(self::ACCESS_KEY,     $credentials->getAccessKey());
        $this->assertSame(self::SECRET_KEY,     $credentials->getSecretKey());
        $this->assertSame(self::MWS_AUTH_TOKEN, $credentials->getMwsAuthToken());
    }

    /**
     * @covers SellerWorks\Amazon\Credentials\Credentials::serialize
     * @covers SellerWorks\Amazon\Credentials\Credentials::unserialize
     */
    public function testSerialize()
    {
        $credentials  = new Credentials(self::SELLER_ID, self::ACCESS_KEY, self::SECRET_KEY, self::MWS_AUTH_TOKEN);
        $serialized   = serialize($credentials);
        $unserialized = unserialize($serialized);

        $this->assertEquals($credentials, $unserialized);
    }
}
