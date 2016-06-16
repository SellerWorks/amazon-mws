<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\FulfillmentInbound;

use Error;
use Faker;
use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\Common\Requests\GetServiceStatusRequest;
use SellerWorks\Amazon\MWS\Common\Requests\NullRequest;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Results;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Serializer;
use UnexpectedValueException;

/**
 * Serializer tests
 */
class SerializerTest extends TestCase
{
    /**
     * Test exception
     */
    public function test_exception()
    {
        $this->expectException(UnexpectedValueException::class);

        $request    = new NullRequest;
        $serializer = new Serializer;
        $serializer->serialize($request);
    }

    /**
     * Test Error
     */
    public function test_serializeGetServiceStatus()
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
    public function test_serializeCreateInboundShipmentPlan()
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
        $request->ShipFromAddress->CountryCode         = $faker->countryCode;
        $request->ShipFromAddress->PostalCode          = $faker->postcode;

        $request->ShipToCountryCode = $faker->countryCode;
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

    /**
     *  Test CreateInboundShipment
     */
    public function test_serializeCreateInboundShipment()
    {
        $faker = Faker\Factory::create();

        $request = new Requests\CreateInboundShipmentRequest;
        $request->ShipmentId = $faker->word;
        $request->InboundShipmentHeader = $header = new Entities\InboundShipmentHeader;
        $request->InboundShipmentItems  = [];

        $header->ShipmentName                         = $faker->name;
        $header->ShipFromAddress                      = new Entities\Address;
        $header->ShipFromAddress->Name                = $faker->name;
        $header->ShipFromAddress->AddressLine1        = $faker->streetAddress;
        $header->ShipFromAddress->AddressLine2        = $faker->word;
        $header->ShipFromAddress->City                = $faker->city;
        $header->ShipFromAddress->DistrictOrCounty    = $faker->word;
        $header->ShipFromAddress->StateOrProvinceCode = $faker->stateAbbr;
        $header->ShipFromAddress->CountryCode         = $faker->countryCode;
        $header->ShipFromAddress->PostalCode          = $faker->postcode;
        $header->DestinationFulfillmentCenterId       = $faker->word;
        $header->LabelPrepPreference                  = $faker->word;
        $header->AreCasesRequired                     = rand(0, 1)? true : false;
        $header->ShipmentStatus                       = $faker->word;

        $expected = [];
        $count    = rand(1, 10);
        for ($i = 0; $i < $count; ++$i) {
            $item = new Entities\InboundShipmentItem;
            $item->ShipmentId            = $request->ShipmentId;
            $item->SellerSKU             = $faker->isbn10;
            $item->FulfillmentNetworkSKU = $faker->isbn13;
            $item->QuantityShipped       = $faker->randomDigitNotNull;
            $item->QuantityReceived      = $faker->randomDigitNotNull;
            $item->QuantityInCase        = $faker->randomDigitNotNull;
            $item->ReleaseDate           = $faker->date();

            $prep = new Entities\PrepDetails;
            $prep->PrepInstruction = $faker->word;
            $prep->PrepOwner       = $faker->word;
            $item->PrepDetailsList = [$prep];

            $request->InboundShipmentItems[] = $item;

            $prefix = sprintf('InboundShipmentItems.member.%s.', $i + 1);
            $expected[$prefix.'ShipmentId']            = $item->ShipmentId;
            $expected[$prefix.'SellerSKU']             = $item->SellerSKU;
            $expected[$prefix.'FulfillmentNetworkSKU'] = $item->FulfillmentNetworkSKU;
            $expected[$prefix.'QuantityShipped']       = $item->QuantityShipped;
            $expected[$prefix.'QuantityReceived']      = $item->QuantityReceived;
            $expected[$prefix.'QuantityInCase']        = $item->QuantityInCase;
            $expected[$prefix.'ReleaseDate']           = $item->ReleaseDate;

            $prefix = sprintf('%sPrepDetailsList.PrepDetails.1.', $prefix);
            $expected[$prefix.'PrepInstruction'] = $prep->PrepInstruction;
            $expected[$prefix.'PrepOwner']       = $prep->PrepOwner;
        }

        $expected = array_merge($expected, [
            'Action'                                                    => 'CreateInboundShipment',
            'ShipmentId'                                                => $request->ShipmentId,
            'InboundShipmentHeader.ShipmentName'                        => $header->ShipmentName,
            'InboundShipmentHeader.ShipFromAddress.Name'                => $header->ShipFromAddress->Name,
            'InboundShipmentHeader.ShipFromAddress.AddressLine1'        => $header->ShipFromAddress->AddressLine1,
            'InboundShipmentHeader.ShipFromAddress.AddressLine2'        => $header->ShipFromAddress->AddressLine2,
            'InboundShipmentHeader.ShipFromAddress.City'                => $header->ShipFromAddress->City,
            'InboundShipmentHeader.ShipFromAddress.DistrictOrCounty'    => $header->ShipFromAddress->DistrictOrCounty,
            'InboundShipmentHeader.ShipFromAddress.StateOrProvinceCode' => $header->ShipFromAddress->StateOrProvinceCode,
            'InboundShipmentHeader.ShipFromAddress.CountryCode'         => $header->ShipFromAddress->CountryCode,
            'InboundShipmentHeader.ShipFromAddress.PostalCode'          => $header->ShipFromAddress->PostalCode,
            'InboundShipmentHeader.DestinationFulfillmentCenterId'      => $header->DestinationFulfillmentCenterId,
            'InboundShipmentHeader.LabelPrepPreference'                 => $header->LabelPrepPreference,
            'InboundShipmentHeader.AreCasesRequired'                    => $header->AreCasesRequired? 'true' : 'false',
            'InboundShipmentHeader.ShipmentStatus'                      => $header->ShipmentStatus,
        ]);

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);

        // Check with DateTimeInterfaace.
        $pos = 1;

        foreach ($request->InboundShipmentItems as $i) {
            $i->ReleaseDate = $faker->dateTimeThisYear();
            
            $key = sprintf('InboundShipmentItems.member.%s.ReleaseDate', $pos);
            $expected[$key] = $i->ReleaseDate->format('Y-m-d');
            ++$pos;
        }

        $actual = $serializer->serialize($request);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     *  Test UpdateInboundShipment
     */
    public function test_serializeUpdateInboundShipment()
    {
        $faker = Faker\Factory::create();

        $request = new Requests\UpdateInboundShipmentRequest;
        $request->ShipmentId = $faker->word;
        $request->InboundShipmentHeader = $header = new Entities\InboundShipmentHeader;
        $request->InboundShipmentItems  = [];

        $header->ShipmentName                         = $faker->name;
        $header->ShipFromAddress                      = new Entities\Address;
        $header->ShipFromAddress->Name                = $faker->name;
        $header->ShipFromAddress->AddressLine1        = $faker->streetAddress;
        $header->ShipFromAddress->AddressLine2        = $faker->word;
        $header->ShipFromAddress->City                = $faker->city;
        $header->ShipFromAddress->DistrictOrCounty    = $faker->word;
        $header->ShipFromAddress->StateOrProvinceCode = $faker->stateAbbr;
        $header->ShipFromAddress->CountryCode         = $faker->countryCode;
        $header->ShipFromAddress->PostalCode          = $faker->postcode;
        $header->DestinationFulfillmentCenterId       = $faker->word;
        $header->LabelPrepPreference                  = $faker->word;
        $header->AreCasesRequired                     = rand(0, 1)? true : false;
        $header->ShipmentStatus                       = $faker->word;

        $expected = [];
        $count    = rand(1, 10);
        for ($i = 0; $i < $count; ++$i) {
            $item = new Entities\InboundShipmentItem;
            $item->ShipmentId            = $request->ShipmentId;
            $item->SellerSKU             = $faker->isbn10;
            $item->FulfillmentNetworkSKU = $faker->isbn13;
            $item->QuantityShipped       = $faker->randomDigitNotNull;
            $item->QuantityReceived      = $faker->randomDigitNotNull;
            $item->QuantityInCase        = $faker->randomDigitNotNull;
            $item->ReleaseDate           = $faker->date();

            $prep = new Entities\PrepDetails;
            $prep->PrepInstruction = $faker->word;
            $prep->PrepOwner       = $faker->word;
            $item->PrepDetailsList = [$prep];

            $request->InboundShipmentItems[] = $item;

            $prefix = sprintf('InboundShipmentItems.member.%s.', $i + 1);
            $expected[$prefix.'ShipmentId']            = $item->ShipmentId;
            $expected[$prefix.'SellerSKU']             = $item->SellerSKU;
            $expected[$prefix.'FulfillmentNetworkSKU'] = $item->FulfillmentNetworkSKU;
            $expected[$prefix.'QuantityShipped']       = $item->QuantityShipped;
            $expected[$prefix.'QuantityReceived']      = $item->QuantityReceived;
            $expected[$prefix.'QuantityInCase']        = $item->QuantityInCase;
            $expected[$prefix.'ReleaseDate']           = $item->ReleaseDate;

            $prefix = sprintf('%sPrepDetailsList.PrepDetails.1.', $prefix);
            $expected[$prefix.'PrepInstruction'] = $prep->PrepInstruction;
            $expected[$prefix.'PrepOwner']       = $prep->PrepOwner;
        }

        $expected = array_merge($expected, [
            'Action'                                                    => 'UpdateInboundShipment',
            'ShipmentId'                                                => $request->ShipmentId,
            'InboundShipmentHeader.ShipmentName'                        => $header->ShipmentName,
            'InboundShipmentHeader.ShipFromAddress.Name'                => $header->ShipFromAddress->Name,
            'InboundShipmentHeader.ShipFromAddress.AddressLine1'        => $header->ShipFromAddress->AddressLine1,
            'InboundShipmentHeader.ShipFromAddress.AddressLine2'        => $header->ShipFromAddress->AddressLine2,
            'InboundShipmentHeader.ShipFromAddress.City'                => $header->ShipFromAddress->City,
            'InboundShipmentHeader.ShipFromAddress.DistrictOrCounty'    => $header->ShipFromAddress->DistrictOrCounty,
            'InboundShipmentHeader.ShipFromAddress.StateOrProvinceCode' => $header->ShipFromAddress->StateOrProvinceCode,
            'InboundShipmentHeader.ShipFromAddress.CountryCode'         => $header->ShipFromAddress->CountryCode,
            'InboundShipmentHeader.ShipFromAddress.PostalCode'          => $header->ShipFromAddress->PostalCode,
            'InboundShipmentHeader.DestinationFulfillmentCenterId'      => $header->DestinationFulfillmentCenterId,
            'InboundShipmentHeader.LabelPrepPreference'                 => $header->LabelPrepPreference,
            'InboundShipmentHeader.AreCasesRequired'                    => $header->AreCasesRequired? 'true' : 'false',
            'InboundShipmentHeader.ShipmentStatus'                      => $header->ShipmentStatus,
        ]);

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     *  Test GetPrepInstructionsForSKU
     */
    public function test_serializeGetPrepInstructionsForSKU()
    {
        $faker = Faker\Factory::create();

        $request = new Requests\GetPrepInstructionsForSKURequest;
        $request->SellerSKUList     = [];
        $request->ShipToCountryCode = $faker->countryCode;

        $expected = [];
        $count    = rand(1, 50);
        for ($i = 0; $i < $count; ++$i) {
            $request->SellerSKUList[] = $word = $faker->word;

            $prefix = sprintf('SellerSKUList.Id.%s', $i + 1);
            $expected[$prefix] = $word;
        }

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        $expected = array_merge($expected, [
            'Action'            => 'GetPrepInstructionsForSKU',
            'ShipToCountryCode' => $request->ShipToCountryCode,
        ]);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     *  Test GetPrepInstructionsForASIN
     */
    public function test_serializeGetPrepInstructionsForASIN()
    {
        $faker = Faker\Factory::create();

        $request = new Requests\GetPrepInstructionsForASINRequest;
        $request->SellerASINList     = [];
        $request->ShipToCountryCode = $faker->countryCode;

        $expected = [];
        $count    = rand(1, 50);
        for ($i = 0; $i < $count; ++$i) {
            $request->SellerASINList[] = $word = $faker->word;

            $prefix = sprintf('SellerASINList.Id.%s', $i + 1);
            $expected[$prefix] = $word;
        }

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        $expected = array_merge($expected, [
            'Action'            => 'GetPrepInstructionsForASIN',
            'ShipToCountryCode' => $request->ShipToCountryCode,
        ]);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     *  Test ListInboundShipments
     */
    public function test_serializeListInboundShipments()
    {
        $faker = Faker\Factory::create();

        $request = new Requests\ListInboundShipmentsRequest;
        $request->ShipmentStatusList = [];
        $request->ShipmentIdList     = [];
        $request->LastUpdatedAfter   = $faker->dateTimeThisYear();
        $request->LastUpdatedBefore  = $faker->dateTimeThisYear();

        $expected = [];
        $count    = rand(1, 50);
        for ($i = 0; $i < $count; ++$i) {
            $request->ShipmentStatusList[] = $status = $faker->word;
            $request->ShipmentIdList[]     = $id = $faker->word;

            $expected[sprintf('ShipmentStatusList.member.%s', $i + 1)] = $status;
            $expected[sprintf('ShipmentIdList.member.%s', $i + 1)] = $id;
        }

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        $expected = array_merge($expected, [
            'Action'            => 'ListInboundShipments',
            'LastUpdatedAfter'  => $request->LastUpdatedAfter->format(Serializer::DATE_FORMAT),
            'LastUpdatedBefore' => $request->LastUpdatedBefore->format(Serializer::DATE_FORMAT),
        ]);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);


        // Test with date time strings.
        $request->LastUpdatedAfter     = $faker->dateTimeThisYear()->format(Serializer::DATE_FORMAT);
        $request->LastUpdatedBefore    = $faker->dateTimeThisYear()->format(Serializer::DATE_FORMAT);
        $expected['LastUpdatedAfter']  = $request->LastUpdatedAfter;
        $expected['LastUpdatedBefore'] = $request->LastUpdatedBefore;

        $actual = $serializer->serialize($request);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     *  Test ListInboundShipmentsByNextToken
     */
    public function test_serializeListInboundShipmentsByNextToken()
    {
        $faker = Faker\Factory::create();

        $request = new Requests\ListInboundShipmentsByNextTokenRequest;
        $request->NextToken = $faker->uuid;

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        $expected = [
            'Action'    => 'ListInboundShipmentsByNextToken',
            'NextToken' => $request->NextToken,
        ];

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     *  Test ListInboundShipmentItems
     */
    public function test_serializeListInboundShipmentItems()
    {
        $faker = Faker\Factory::create();

        $request = new Requests\ListInboundShipmentItemsRequest;
        $request->ShipmentId         = $faker->word;
        $request->LastUpdatedAfter   = $faker->dateTimeThisYear();
        $request->LastUpdatedBefore  = $faker->dateTimeThisYear();

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        $expected = [
            'Action'            => 'ListInboundShipmentItems',
            'ShipmentId'        => $request->ShipmentId,
            'LastUpdatedAfter'  => $request->LastUpdatedAfter->format(Serializer::DATE_FORMAT),
            'LastUpdatedBefore' => $request->LastUpdatedBefore->format(Serializer::DATE_FORMAT),
        ];

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);


        // Test with date time strings.
        $request->LastUpdatedAfter     = $faker->dateTimeThisYear()->format(Serializer::DATE_FORMAT);
        $request->LastUpdatedBefore    = $faker->dateTimeThisYear()->format(Serializer::DATE_FORMAT);
        $expected['LastUpdatedAfter']  = $request->LastUpdatedAfter;
        $expected['LastUpdatedBefore'] = $request->LastUpdatedBefore;

        $actual = $serializer->serialize($request);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     *  Test ListInboundShipmentItemsByNextToken
     */
    public function test_serializeListInboundShipmentItemsByNextToken()
    {
        $faker = Faker\Factory::create();

        $request = new Requests\ListInboundShipmentItemsByNextTokenRequest;
        $request->NextToken = $faker->uuid;

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        $expected = [
            'Action'    => 'ListInboundShipmentItemsByNextToken',
            'NextToken' => $request->NextToken,
        ];

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }
}