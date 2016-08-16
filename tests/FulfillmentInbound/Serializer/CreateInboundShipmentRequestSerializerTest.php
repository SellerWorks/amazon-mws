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
class CreateInboundShipmentRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test CreateInboundShipment.ShipmentId
     */
    public function test_CreateInboundShipment_ShipmentId()
    {
        $serializer = new Serializer;

        $request = new Request\CreateInboundShipmentRequest;
        $request->ShipmentId = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'ShipmentId' => $request->ShipmentId,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader
     */
    public function test_CreateInboundShipment_InboundShipmentHeader()
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

        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = $header;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
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
            'InboundShipmentHeader.AreCasesRequired' => $header->AreCasesRequired,
            'InboundShipmentHeader.ShipmentStatus' => $header->ShipmentStatus,
            'InboundShipmentHeader.IntendedBoxContentsSource' => $header->IntendedBoxContentsSource,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
