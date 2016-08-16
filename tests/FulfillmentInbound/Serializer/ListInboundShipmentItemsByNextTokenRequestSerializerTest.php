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
class ListInboundShipmentItemsByNextTokenRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test ListInboundShipmentItemsByNextTokenRequest.NextToken
     */
    public function test_ListInboundShipmentItemsByNextTokenRequest_NextToken()
    {
        $serializer = new Serializer;

        $request = new Request\ListInboundShipmentItemsByNextTokenRequest;
        $request->NextToken = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action'    => 'ListInboundShipmentItemsByNextToken',
            'NextToken' => $request->NextToken,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
