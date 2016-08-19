<?php

namespace SellerWorks\Amazon\Tests\Credentials;

use Faker;
use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Credentials;

/**
 * Serializer tests
 */
class CredentialsTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test Credentials.*
     */
    public function test_Credentials_create()
    {
        $SellerId = $this->faker->uuid;
        $AccessKey = $this->faker->uuid;
        $SecretKey = $this->faker->uuid;
        $MwsAuthToken = $this->faker->uuid;


        // Without MwsAuthToken
        $credentials = new Credentials\Credentials($SellerId, $AccessKey, $SecretKey);

        $this->assertSame($SellerId,  $credentials->getSellerId());
        $this->assertSame($AccessKey, $credentials->getAccessKey());
        $this->assertSame($SecretKey, $credentials->getSecretKey());
        $this->assertSame('',         $credentials->getMwsAuthToken());


        // With MwsAuthToken
        $credentials = new Credentials\Credentials($SellerId, $AccessKey, $SecretKey, $MwsAuthToken);

        $this->assertSame($SellerId,     $credentials->getSellerId());
        $this->assertSame($AccessKey,    $credentials->getAccessKey());
        $this->assertSame($SecretKey,    $credentials->getSecretKey());
        $this->assertSame($MwsAuthToken, $credentials->getMwsAuthToken());
    }
}
