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
class ListInboundShipmentsByNextTokenRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test ListInboundShipmentsByNextTokenRequest.NextToken
     */
    public function test_ListInboundShipmentsByNextTokenRequest_NextToken()
    {
        $serializer = new Serializer;

        $request = new Request\ListInboundShipmentsByNextTokenRequest;
        $request->NextToken = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action'    => 'ListInboundShipmentsByNextToken',
            'NextToken' => $request->NextToken,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
