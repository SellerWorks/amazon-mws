<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\Common;

use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\Common\Passport;

/**
 * Passport tests.
 */
class PassportTest extends TestCase
{
    /**
     * Test creating a Passport object, and that it returns all values.
     */
    public function testCreate()
    {
        // Setup vars.
        $SellerId     = 'SELLER_ID';
        $AccessKey    = 'ACCESS_KEY';
        $SecretKey    = 'SECRET_KEY';
        $MwsAuthToken = 'MWS_AUTH_CODE';

        // Creeate a known value object.
        $passport = new Passport($SellerId, $AccessKey, $SecretKey, $MwsAuthToken);

        // Assertions.
        $this->assertEquals($SellerId, $passport->getSellerId());
        $this->assertEquals($AccessKey, $passport->getAccessKey());
        $this->assertEquals($SecretKey, $passport->getSecretKey());
        $this->assertEquals($MwsAuthToken, $passport->getMwsAuthToken());
    }
}