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
class CreateInboundShipmentPlanRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test CreateInboundShipmentPlanRequest.ShipFromAddress
     */
    public function test_CreateInboundShipmentPlanRequest_ShipFromAddress()
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

        $request = new Request\CreateInboundShipmentPlanRequest;
        $request->ShipFromAddress = $address;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipmentPlan',
            'ShipFromAddress.Name' => $address->Name,
            'ShipFromAddress.AddressLine1' => $address->AddressLine1,
            'ShipFromAddress.AddressLine2' => $address->AddressLine2,
            'ShipFromAddress.City' => $address->City,
            'ShipFromAddress.DistrictOrCounty' => $address->DistrictOrCounty,
            'ShipFromAddress.StateOrProvinceCode' => $address->StateOrProvinceCode,
            'ShipFromAddress.CountryCode' => $address->CountryCode,
            'ShipFromAddress.PostalCode' => $address->PostalCode,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipmentPlanRequest.ShipToCountryCode
     */
    public function test_CreateInboundShipmentPlanRequest_ShipToCountryCode()
    {
        $serializer = new Serializer;

        $request = new Request\CreateInboundShipmentPlanRequest;
        $request->ShipToCountryCode = $this->faker->countryCode;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipmentPlan',
            'ShipToCountryCode' => $request->ShipToCountryCode,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipmentPlanRequest.ShipToCountrySubdivisionCode
     */
    public function test_CreateInboundShipmentPlanRequest_ShipToCountrySubdivisionCode()
    {
        $serializer = new Serializer;

        $request = new Request\CreateInboundShipmentPlanRequest;
        $request->ShipToCountrySubdivisionCode = $this->faker->countryCode;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipmentPlan',
            'ShipToCountrySubdivisionCode' => $request->ShipToCountrySubdivisionCode,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipmentPlanRequest.LabelPrepPreference
     */
    public function test_CreateInboundShipmentPlanRequest_LabelPrepPreference()
    {
        $serializer = new Serializer;

        $request = new Request\CreateInboundShipmentPlanRequest;
        $request->LabelPrepPreference = 'SELLER_LABEL';

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipmentPlan',
            'LabelPrepPreference' => $request->LabelPrepPreference,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipmentPlanRequest.LabelPrepPreference (invalid)
     */
    public function test_CreateInboundShipmentPlanRequest_LabelPrepPreference_invalid()
    {
        $serializer = new Serializer;

        $request = new Request\CreateInboundShipmentPlanRequest;
        $request->LabelPrepPreference = 'INVALID';

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipmentPlan',
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipmentPlanRequest.InboundShipmentPlanRequestItems (empty)
     */
    public function test_CreateInboundShipmentPlanRequest_InboundShipmentPlanRequestItems_empty()
    {
        $serializer = new Serializer;

        $request = new Request\CreateInboundShipmentPlanRequest;
        $request->InboundShipmentPlanRequestItems = null;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipmentPlan',
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipmentPlanRequest.InboundShipmentPlanRequestItems (one)
     */
    public function test_CreateInboundShipmentPlanRequest_InboundShipmentPlanRequestItems_one()
    {
        $serializer = new Serializer;

        $item = new Entity\InboundShipmentPlanRequestItem;
        $item->SellerSKU = $this->faker->uuid;
        $item->ASIN = $this->faker->uuid;
        $item->Condition = 'NewItem';
        $item->Quantity = $this->faker->randomDigitNotNull;
        $item->QuantityInCase = $this->faker->randomDigitNotNull;

        $request = new Request\CreateInboundShipmentPlanRequest;
        $request->InboundShipmentPlanRequestItems = $item;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipmentPlan',
            'InboundShipmentPlanRequestItems.member.1.SellerSKU'      => $item->SellerSKU,
            'InboundShipmentPlanRequestItems.member.1.ASIN'           => $item->ASIN,
            'InboundShipmentPlanRequestItems.member.1.Condition'      => $item->Condition,
            'InboundShipmentPlanRequestItems.member.1.Quantity'       => $item->Quantity,
            'InboundShipmentPlanRequestItems.member.1.QuantityInCase' => $item->QuantityInCase,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipmentPlanRequest.InboundShipmentPlanRequestItems (multi)
     */
    public function test_CreateInboundShipmentPlanRequest_InboundShipmentPlanRequestItems_multi()
    {
        $serializer = new Serializer;

        $items = [];
        $expected = [];

        for ($i = 1; $i <= 50; ++$i) {
            $path = sprintf('InboundShipmentPlanRequestItems.member.%s.', $i);

            $item = new Entity\InboundShipmentPlanRequestItem;
            $item->SellerSKU      = $expected[$path.'SellerSKU']      = $this->faker->uuid;
            $item->ASIN           = $expected[$path.'ASIN']           = $this->faker->uuid;
            $item->Condition      = $expected[$path.'Condition']      = 'NewItem';
            $item->Quantity       = $expected[$path.'Quantity']       = $this->faker->randomDigitNotNull;
            $item->QuantityInCase = $expected[$path.'QuantityInCase'] = $this->faker->randomDigitNotNull;

            $items[] = $item;
        }

        $request = new Request\CreateInboundShipmentPlanRequest;
        $request->InboundShipmentPlanRequestItems = $items;

        $serialized = $serializer->serialize($request);
        $expected['Action'] = 'CreateInboundShipmentPlan';

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
