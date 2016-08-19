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
class UpdateInboundShipmentRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test UpdateInboundShipment.ShipmentId
     */
    public function test_UpdateInboundShipment_ShipmentId()
    {
        $serializer = new Serializer;

        $request = new Request\UpdateInboundShipmentRequest;
        $request->ShipmentId = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'UpdateInboundShipment',
            'ShipmentId' => $request->ShipmentId,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test UpdateInboundShipment.InboundShipmentHeader
     */
    public function test_UpdateInboundShipment_InboundShipmentHeader()
    {
        $serializer = new Serializer;

        $address = new Entity\Address;
        $address->Name                  = $this->faker->name;
        $address->AddressLine1          = $this->faker->streetAddress;
        $address->AddressLine2          = $this->faker->secondaryAddress;
        $address->City                  = $this->faker->city;
        $address->DistrictOrCounty      = $this->faker->citySuffix;
        $address->StateOrProvinceCode   = $this->faker->stateAbbr;
        $address->CountryCode           = $this->faker->countryCode;
        $address->PostalCode            = $this->faker->postcode;

        $header = new Entity\InboundShipmentHeader;
        $header->ShipmentName                   = $this->faker->sentence;
        $header->ShipFromAddress                = $address;
        $header->DestinationFulfillmentCenterId = $this->faker->countryCode;
        $header->LabelPrepPreference            = 'SELLER_LABEL';
        $header->AreCasesRequired               = false;
        $header->ShipmentStatus                 = 'WORKING';
        $header->IntendedBoxContentsSource      = 'NONE';

        $request = new Request\UpdateInboundShipmentRequest;
        $request->InboundShipmentHeader = $header;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'UpdateInboundShipment',
            'InboundShipmentHeader.ShipmentName' => $header->ShipmentName,
            'InboundShipmentHeader.ShipFromAddress.Name' => $address->Name,
            'InboundShipmentHeader.ShipFromAddress.AddressLine1' => $address->AddressLine1,
            'InboundShipmentHeader.ShipFromAddress.AddressLine2' => $address->AddressLine2,
            'InboundShipmentHeader.ShipFromAddress.City' => $address->City,
            'InboundShipmentHeader.ShipFromAddress.DistrictOrCounty' => $address->DistrictOrCounty,
            'InboundShipmentHeader.ShipFromAddress.StateOrProvinceCode' => $address->StateOrProvinceCode,
            'InboundShipmentHeader.ShipFromAddress.CountryCode' => $address->CountryCode,
            'InboundShipmentHeader.ShipFromAddress.PostalCode' => $address->PostalCode,
            'InboundShipmentHeader.DestinationFulfillmentCenterId' => $header->DestinationFulfillmentCenterId,
            'InboundShipmentHeader.LabelPrepPreference' => $header->LabelPrepPreference,
            'InboundShipmentHeader.AreCasesRequired' => $header->AreCasesRequired? 'true' : 'false',
            'InboundShipmentHeader.ShipmentStatus' => $header->ShipmentStatus,
            'InboundShipmentHeader.IntendedBoxContentsSource' => $header->IntendedBoxContentsSource,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test UpdateInboundShipment.InboundShipmentItems (empty)
     */
    public function test_UpdateInboundShipment_InboundShipmentItems_empty()
    {
        $serializer = new Serializer;

        $request = new Request\UpdateInboundShipmentRequest;
        $request->InboundShipmentItems = null;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'UpdateInboundShipment',
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test UpdateInboundShipment.InboundShipmentItems (one)
     */
    public function test_UpdateInboundShipment_InboundShipmentItems_one()
    {
        $serializer = new Serializer;

        $expected = [];
        $path = 'InboundShipmentItems.member.1.';

        $item = new Entity\InboundShipmentItem;
        $item->ShipmentId            = $expected[$path.'ShipmentId']            = $this->faker->uuid;
        $item->SellerSKU             = $expected[$path.'SellerSKU']             = $this->faker->uuid;
        $item->FulfillmentNetworkSKU = $expected[$path.'FulfillmentNetworkSKU'] = $this->faker->uuid;
        $item->QuantityShipped       = $expected[$path.'QuantityShipped']       = $this->faker->randomDigitNotNull;
        $item->QuantityReceived      = $expected[$path.'QuantityReceived']      = $this->faker->randomDigitNotNull;
        $item->QuantityInCase        = $expected[$path.'QuantityInCase']        = $this->faker->randomDigitNotNull;
//         $item->PrepDetailsList       =
        $item->ReleaseDate           = $this->faker->dateTimeThisCentury();
        $expected[$path.'ReleaseDate'] = $item->ReleaseDate->format(Serializer::DATE_FORMAT);

        $request = new Request\UpdateInboundShipmentRequest;
        $request->InboundShipmentItems = $item;

        $serialized = $serializer->serialize($request);
        $expected['Action'] = 'UpdateInboundShipment';

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test UpdateInboundShipment.InboundShipmentItems (multi)
     */
    public function test_UpdateInboundShipment_InboundShipmentItems_multi()
    {
        $serializer = new Serializer;

        $items = [];
        $expected = [];

        for ($i = 1; $i <= 50; ++$i) {
            $path = sprintf('InboundShipmentItems.member.%s.', $i);

            $item = new Entity\InboundShipmentItem;
            $item->ShipmentId            = $expected[$path.'ShipmentId']            = $this->faker->uuid;
            $item->SellerSKU             = $expected[$path.'SellerSKU']             = $this->faker->uuid;
            $item->FulfillmentNetworkSKU = $expected[$path.'FulfillmentNetworkSKU'] = $this->faker->uuid;
            $item->QuantityShipped       = $expected[$path.'QuantityShipped']       = $this->faker->randomDigitNotNull;
            $item->QuantityReceived      = $expected[$path.'QuantityReceived']      = $this->faker->randomDigitNotNull;
            $item->QuantityInCase        = $expected[$path.'QuantityInCase']        = $this->faker->randomDigitNotNull;
            $item->ReleaseDate           = $expected[$path.'ReleaseDate']           = $this->faker->date(Serializer::DATE_FORMAT);

            $items[] = $item;
        }

        $request = new Request\UpdateInboundShipmentRequest;
        $request->InboundShipmentItems = $items;

        $serialized = $serializer->serialize($request);
        $expected['Action'] = 'UpdateInboundShipment';

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
