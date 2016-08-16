<?php

namespace SellerWorks\Amazon\Tests\FulfillmentInbound\Serializer;

use Faker;
use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\FulfillmentInbound\Entity;
use SellerWorks\Amazon\FulfillmentInbound\Request;
use SellerWorks\Amazon\FulfillmentInbound\Serializer\Serializer;

/**
 * Serializer tests
 */
class GetPreorderInfoRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test GetPreorderInfoRequest.ShipmentId
     */
    public function test_GetPreorderInfoRequest_ShipmentId()
    {
        $serializer = new Serializer;

        $request = new Request\GetPreorderInfoRequest;
        $request->ShipmentId = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'GetPreorderInfo',
            'ShipmentId' => $request->ShipmentId,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
