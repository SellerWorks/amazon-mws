<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\FulfillmentInbound;

use Error;
use Faker;
use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\Common\Requests\GetServiceStatusRequest;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Results;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Serializer;

/**
 * Serializer tests
 */
class SerializerTest extends TestCase
{
    /**
     * Test Error
     */
    public function test_serialize_GetServiceStatus()
    {
        $request  = new GetServiceStatusRequest;
        $expected = [
            'Action' => 'GetServiceStatus',
        ];

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test CreateInboundShipmentPlan
     */
    public function test_serialize_CreateInboundShipmentPlan()
    {
        $faker = Faker\Factory::create();

        $request = new Requests\CreateInboundShipmentPlanRequest;
        $request->ShipFromAddress = new Entities\Address;
        $request->ShipFromAddress->Name                = $faker->name;
        $request->ShipFromAddress->AddressLine1        = $faker->streetAddress;
        $request->ShipFromAddress->AddressLine2        = $faker->word;
        $request->ShipFromAddress->City                = $faker->city;
        $request->ShipFromAddress->DistrictOrCounty    = $faker->word;
        $request->ShipFromAddress->StateOrProvinceCode = $faker->stateAbbr;
        $request->ShipFromAddress->CountryCode         = $faker->word;
        $request->ShipFromAddress->PostalCode          = $faker->postcode;

        $request->ShipToCountryCode = $faker->word;
        $request->ShipToCountrySubdivisionCode = $faker->word;
        $request->LabelPrepPreference = $faker->word;
        $request->InboundShipmentPlanRequestItems = [];

        $expected = [];
        $count    = rand(1, 10);
        for ($i = 0; $i < $count; ++$i) {
            $item = new Entities\InboundShipmentPlanRequestItem;
            $item->SellerSKU      = $faker->isbn10;
            $item->ASIN           = $faker->isbn13;
            $item->Condition      = $faker->word;
            $item->Quantity       = $faker->randomDigitNotNull;
            $item->QuantityInCase = $faker->randomDigitNotNull;
            
            $prep = new Entities\PrepDetails;
            $prep->PrepInstruction = $faker->word;
            $prep->PrepOwner       = $faker->word;
            $item->PrepDetailsList = [$prep];

            $request->InboundShipmentPlanRequestItems[] = $item;

            $prefix = sprintf('InboundShipmentPlanRequestItems.member.%s.', $i + 1);
            $expected[$prefix.'SellerSKU']      = $item->SellerSKU;
            $expected[$prefix.'ASIN']           = $item->ASIN;
            $expected[$prefix.'Condition']      = $item->Condition;
            $expected[$prefix.'Quantity']       = $item->Quantity;
            $expected[$prefix.'QuantityInCase'] = $item->QuantityInCase;

            $prefix = sprintf('%sPrepDetailsList.PrepDetails.1.', $prefix);
            $expected[$prefix.'PrepInstruction'] = $prep->PrepInstruction;
            $expected[$prefix.'PrepOwner']       = $prep->PrepOwner;
        }

        $expected = array_merge($expected, [
            'Action'                              => 'CreateInboundShipmentPlan',
            'ShipFromAddress.Name'                => $request->ShipFromAddress->Name,
            'ShipFromAddress.AddressLine1'        => $request->ShipFromAddress->AddressLine1,
            'ShipFromAddress.AddressLine2'        => $request->ShipFromAddress->AddressLine2,
            'ShipFromAddress.City'                => $request->ShipFromAddress->City,
            'ShipFromAddress.DistrictOrCounty'    => $request->ShipFromAddress->DistrictOrCounty,
            'ShipFromAddress.StateOrProvinceCode' => $request->ShipFromAddress->StateOrProvinceCode,
            'ShipFromAddress.CountryCode'         => $request->ShipFromAddress->CountryCode,
            'ShipFromAddress.PostalCode'          => $request->ShipFromAddress->PostalCode,
            'ShipToCountryCode'                   => $request->ShipToCountryCode,
            'ShipToCountrySubdivisionCode'        => $request->ShipToCountrySubdivisionCode,
            'LabelPrepPreference'                 => $request->LabelPrepPreference,
        ]);

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }
}