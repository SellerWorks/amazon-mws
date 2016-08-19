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
class ListInboundShipmentsRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test ListInboundShipmentsRequest.ShipmentStatusList
     */
    public function test_ListInboundShipmentsRequest_ShipmentStatusList()
    {
        $serializer = new Serializer;

        // Check for value.
        $request = new Request\ListInboundShipmentsRequest;
        $expected = ['Action' => 'ListInboundShipments'];

        $choices = $request->getMetadata()['ShipmentStatusList']['choices'];

        foreach ($choices as $choice) {
            $request->ShipmentStatusList = $choice;

            $serialized = $serializer->serialize($request);
            $expected['ShipmentStatusList.Status.1'] = $choice;

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }

        // Check for null.
        $request->ShipmentStatusList = '';
        $serialized = $serializer->serialize($request);
        unset($expected['ShipmentStatusList.Status.1']);

        $this->assertSame($serialized, $expected);

        // Check for invalid.
        $request->ShipmentStatusList = 'NOT_A_VALUE';
        $serialized = $serializer->serialize($request);

        $this->assertSame($serialized, $expected);

        // Check for multi-value.
        $request->ShipmentStatusList = [];

        foreach (array_values($choices) as $i => $choice) {
            $request->ShipmentStatusList[] = $choice;
            $expected[sprintf('ShipmentStatusList.Status.%s', $i + 1)] = $choice;
        }

        $serialized = $serializer->serialize($request);
        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListInboundShipmentsRequest.ShipmentIdList
     */
    public function test_ListInboundShipmentsRequest_ShipmentIdList()
    {
        $serializer = new Serializer;

        // Check for value.
        $value = $this->faker->uuid;

        $request = new Request\ListInboundShipmentsRequest;
        $request->ShipmentIdList = $value;

        $expected = [
            'Action' => 'ListInboundShipments',
            'ShipmentIdList.Id.1' => $value,
        ];

        $serialized = $serializer->serialize($request);
        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->ShipmentIdList = '';
        $serialized = $serializer->serialize($request);
        unset($expected['ShipmentIdList.Id.1']);

        $this->assertSame($serialized, $expected);

        // Check for multi-value.
        $request->ShipmentIdList = [];

        for ($i = 1; $i <= 10; ++$i) {
            $value = $this->faker->uuid;
            $request->ShipmentIdList[] = $value;
            $expected[sprintf('ShipmentIdList.Id.%s', $i)] = $value;
        }

        $serialized = $serializer->serialize($request);
        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListInboundShipmentsRequest.{LastUpdatedAfter,LastUpdatedBefore} as DateTime objects.
     */
    public function test_ListInboundShipmentsRequest_dates_as_objects()
    {
        $serializer = new Serializer;

        $request = new Request\ListInboundShipmentsRequest;
        $request->LastUpdatedAfter  = new DateTime($bttf1955 = '1955-11-12T06:38:00Z');
        $request->LastUpdatedBefore = new DateTime($bttf1985 = '1985-10-26T09:00:00Z');

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'            => 'ListInboundShipments',
            'LastUpdatedAfter'  => $bttf1955,
            'LastUpdatedBefore' => $bttf1985,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ListInboundShipmentsRequest.{LastUpdatedAfter,LastUpdatedBefore} as strings.
     */
    public function test_ListInboundShipmentsRequest_dates_as_strings()
    {
        $serializer = new Serializer;

        $request = new Request\ListInboundShipmentsRequest;
        $request->LastUpdatedAfter  = $bttf1955 = '1955-11-12T06:38:00Z';
        $request->LastUpdatedBefore = $bttf1985 = '1985-10-26T09:00:00Z';

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'            => 'ListInboundShipments',
            'LastUpdatedAfter'  => $bttf1955,
            'LastUpdatedBefore' => $bttf1985,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
