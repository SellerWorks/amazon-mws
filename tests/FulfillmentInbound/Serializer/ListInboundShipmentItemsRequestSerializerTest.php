<?php

namespace SellerWorks\Amazon\Tests\FulfillmentInbound\Serializer;

use DateTime;
use Faker;
use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\FulfillmentInbound\Entity;
use SellerWorks\Amazon\FulfillmentInbound\Request;
use SellerWorks\Amazon\FulfillmentInbound\Serializer\Serializer;

/**
 * Serializer tests
 */
class ListInboundShipmentItemsRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test ListInboundShipmentItemsRequest.ShipmentId
     */
    public function test_ListInboundShipmentItemsRequest_ShipmentId()
    {
        $serializer = new Serializer;

        // Check for value.
        $value = $this->faker->uuid;

        $request = new Request\ListInboundShipmentItemsRequest;
        $request->ShipmentId = $value;

        $expected = [
            'Action' => 'ListInboundShipmentItems',
            'ShipmentId' => $value,
        ];

        $serialized = $serializer->serialize($request);
        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->ShipmentId = '';
        $serialized = $serializer->serialize($request);
        unset($expected['ShipmentId']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListInboundShipmentItemsRequest.{LastUpdatedAfter,LastUpdatedBefore} as DateTime objects.
     */
    public function test_ListInboundShipmentItemsRequest_dates_as_objects()
    {
        $serializer = new Serializer;

        $request = new Request\ListInboundShipmentItemsRequest;
        $request->LastUpdatedAfter  = new DateTime($bttf1955 = '1955-11-12T06:38:00Z');
        $request->LastUpdatedBefore = new DateTime($bttf1985 = '1985-10-26T09:00:00Z');

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'            => 'ListInboundShipmentItems',
            'LastUpdatedAfter'  => $bttf1955,
            'LastUpdatedBefore' => $bttf1985,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListInboundShipmentItemsRequest.{LastUpdatedAfter,LastUpdatedBefore} as strings.
     */
    public function test_ListInboundShipmentItemsRequest_dates_as_strings()
    {
        $serializer = new Serializer;

        $request = new Request\ListInboundShipmentItemsRequest;
        $request->LastUpdatedAfter  = $bttf1955 = '1955-11-12T06:38:00Z';
        $request->LastUpdatedBefore = $bttf1985 = '1985-10-26T09:00:00Z';

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'            => 'ListInboundShipmentItems',
            'LastUpdatedAfter'  => $bttf1955,
            'LastUpdatedBefore' => $bttf1985,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
