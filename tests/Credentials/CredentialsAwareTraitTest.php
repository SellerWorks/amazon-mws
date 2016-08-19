<?php

namespace SellerWorks\Amazon\Tests\Credentials;

use Faker;
use ReflectionProperty;
use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Credentials;

/**
 * Serializer tests
 */
class CredentialsAwareTraitTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test CredentialsAwareTrait.setCredentials
     */
    public function test_CredentialsAwareTrait_setCredentials()
    {
        $SellerId = $this->faker->uuid;
        $AccessKey = $this->faker->uuid;
        $SecretKey = $this->faker->uuid;
        $MwsAuthToken = $this->faker->uuid;

        $credentials = new Credentials\Credentials($SellerId, $AccessKey, $SecretKey);

        $stub = new CredentialsAwareTraitStub();
        $stub->setCredentials($credentials);

        $reflection = new ReflectionProperty($stub, 'credentials');
        $reflection->setAccessible(true);

        $this->assertSame($credentials, $reflection->getValue($stub));
    }

    /**
     * Test CredentialsAwareTrait.setCredentials.exception
     */
    public function test_CredentialsAwareTrait_setCredentials_exception()
    {
        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            $this->expectException(\Error::class);
        } else {
            $this->expectException(\PHPUnit_Framework_Error::class);
        }

        $stub = new CredentialsAwareTraitStub();
        $stub->setCredentials(new \DateTime);
    }

    /**
     * Test CredentialsAwareTrait.getCredentials
     */
    public function test_CredentialsAwareTrait_getCredentials()
    {
        $SellerId = $this->faker->uuid;
        $AccessKey = $this->faker->uuid;
        $SecretKey = $this->faker->uuid;
        $MwsAuthToken = $this->faker->uuid;

        $credentials = new Credentials\Credentials($SellerId, $AccessKey, $SecretKey);

        $stub = new CredentialsAwareTraitStub();

        $reflection = new ReflectionProperty($stub, 'credentials');
        $reflection->setAccessible(true);
        $fromStub = $reflection->setValue($stub, $credentials);

        $this->assertSame($credentials, $stub->getCredentials());
    }
}
