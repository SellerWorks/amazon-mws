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

        // Check for value.
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


        // Check for null.
        $request->ShipmentId = '';
        $serialized = $serializer->serialize($request);
        unset($expected['ShipmentId']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.ShipmentName
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_ShipmentName()
    {
        $serializer = new Serializer;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $request->InboundShipmentHeader->ShipmentName = $this->faker->sentence;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentHeader.ShipmentName' => $request->InboundShipmentHeader->ShipmentName,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);


        // Check for null.
        $request->InboundShipmentHeader->ShipmentName = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.ShipmentName']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.ShipFromAddress.Name
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_ShipFromAddress_Name()
    {
        $serializer = new Serializer;
        $value = $this->faker->name;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $request->InboundShipmentHeader->ShipFromAddress = new Entity\Address;
        $request->InboundShipmentHeader->ShipFromAddress->Name = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentHeader.ShipFromAddress.Name' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);


        // Check for null.
        $request->InboundShipmentHeader->ShipFromAddress->Name = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.ShipFromAddress.Name']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.ShipFromAddress.AddressLine1
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_ShipFromAddress_AddressLine1()
    {
        $serializer = new Serializer;
        $value = $this->faker->streetAddress;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $request->InboundShipmentHeader->ShipFromAddress = new Entity\Address;
        $request->InboundShipmentHeader->ShipFromAddress->AddressLine1 = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentHeader.ShipFromAddress.AddressLine1' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);


        // Check for null.
        $request->InboundShipmentHeader->ShipFromAddress->AddressLine1 = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.ShipFromAddress.AddressLine1']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.ShipFromAddress.AddressLine2
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_ShipFromAddress_AddressLine2()
    {
        $serializer = new Serializer;
        $value = $this->faker->secondaryAddress;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $request->InboundShipmentHeader->ShipFromAddress = new Entity\Address;
        $request->InboundShipmentHeader->ShipFromAddress->AddressLine2 = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentHeader.ShipFromAddress.AddressLine2' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);


        // Check for null.
        $request->InboundShipmentHeader->ShipFromAddress->AddressLine2 = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.ShipFromAddress.AddressLine2']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.ShipFromAddress.City
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_ShipFromAddress_City()
    {
        $serializer = new Serializer;
        $value = $this->faker->city;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $request->InboundShipmentHeader->ShipFromAddress = new Entity\Address;
        $request->InboundShipmentHeader->ShipFromAddress->City = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentHeader.ShipFromAddress.City' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);


        // Check for null.
        $request->InboundShipmentHeader->ShipFromAddress->City = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.ShipFromAddress.City']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.ShipFromAddress.DistrictOrCounty
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_ShipFromAddress_DistrictOrCounty()
    {
        $serializer = new Serializer;
        $value = $this->faker->citySuffix;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $request->InboundShipmentHeader->ShipFromAddress = new Entity\Address;
        $request->InboundShipmentHeader->ShipFromAddress->DistrictOrCounty = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentHeader.ShipFromAddress.DistrictOrCounty' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);


        // Check for null.
        $request->InboundShipmentHeader->ShipFromAddress->DistrictOrCounty = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.ShipFromAddress.DistrictOrCounty']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.ShipFromAddress.StateOrProvinceCode
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_ShipFromAddress_StateOrProvinceCode()
    {
        $serializer = new Serializer;
        $value = $this->faker->stateAbbr;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $request->InboundShipmentHeader->ShipFromAddress = new Entity\Address;
        $request->InboundShipmentHeader->ShipFromAddress->StateOrProvinceCode = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentHeader.ShipFromAddress.StateOrProvinceCode' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);


        // Check for null.
        $request->InboundShipmentHeader->ShipFromAddress->StateOrProvinceCode = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.ShipFromAddress.StateOrProvinceCode']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.ShipFromAddress.CountryCode
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_ShipFromAddress_CountryCode()
    {
        $serializer = new Serializer;
        $value = $this->faker->countryCode;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $request->InboundShipmentHeader->ShipFromAddress = new Entity\Address;
        $request->InboundShipmentHeader->ShipFromAddress->CountryCode = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentHeader.ShipFromAddress.CountryCode' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);


        // Check for null.
        $request->InboundShipmentHeader->ShipFromAddress->CountryCode = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.ShipFromAddress.CountryCode']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.ShipFromAddress.PostalCode
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_ShipFromAddress_PostalCode()
    {
        $serializer = new Serializer;
        $value = $this->faker->postcode;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $request->InboundShipmentHeader->ShipFromAddress = new Entity\Address;
        $request->InboundShipmentHeader->ShipFromAddress->PostalCode = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentHeader.ShipFromAddress.PostalCode' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);


        // Check for null.
        $request->InboundShipmentHeader->ShipFromAddress->PostalCode = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.ShipFromAddress.PostalCode']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.DestinationFulfillmentCenterId
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_DestinationFulfillmentCenterId()
    {
        $serializer = new Serializer;
        $value = $this->faker->postcode;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $request->InboundShipmentHeader->DestinationFulfillmentCenterId = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentHeader.DestinationFulfillmentCenterId' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);


        // Check for null.
        $request->InboundShipmentHeader->DestinationFulfillmentCenterId = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.DestinationFulfillmentCenterId']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.LabelPrepPreference
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_LabelPrepPreference()
    {
        $serializer = new Serializer;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $expected = ['Action' => 'CreateInboundShipment'];

        $choices = $request->InboundShipmentHeader->getMetadata()['LabelPrepPreference']['choices'];

        foreach ($choices as $choice) {
            $request->InboundShipmentHeader->LabelPrepPreference = $choice;

            $serialized = $serializer->serialize($request);
            $expected['InboundShipmentHeader.LabelPrepPreference'] = $choice;

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }

        // Check for null.
        $request->InboundShipmentHeader->LabelPrepPreference = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.LabelPrepPreference']);

        $this->assertSame($serialized, $expected);

        // Check for invalid.
        $request->InboundShipmentHeader->LabelPrepPreference = 'NOT_A_VALUE';
        $serialized = $serializer->serialize($request);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.AreCasesRequired
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_AreCasesRequired()
    {
        $serializer = new Serializer;

        // Check for boolean true.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $request->InboundShipmentHeader->AreCasesRequired = true;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentHeader.AreCasesRequired' => 'true',
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);


        // Check for boolean false.
        $request->InboundShipmentHeader->AreCasesRequired = false;
        $serialized = $serializer->serialize($request);
        $expected['InboundShipmentHeader.AreCasesRequired'] = 'false';

        $this->assertSame($serialized, $expected);


        // Check for string TruE. (case insensitive)
        $request->InboundShipmentHeader->AreCasesRequired = 'TruE';
        $serialized = $serializer->serialize($request);
        $expected['InboundShipmentHeader.AreCasesRequired'] = 'true';

        $this->assertSame($serialized, $expected);


        // Check for string FaLSe. (case insensitive)
        $request->InboundShipmentHeader->AreCasesRequired = 'FaLSe';
        $serialized = $serializer->serialize($request);
        $expected['InboundShipmentHeader.AreCasesRequired'] = 'false';

        $this->assertSame($serialized, $expected);


        // Check for null.
        $request->InboundShipmentHeader->AreCasesRequired = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.AreCasesRequired']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.ShipmentStatus
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_ShipmentStatus()
    {
        $serializer = new Serializer;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $expected = ['Action' => 'CreateInboundShipment'];

        $choices = $request->InboundShipmentHeader->getMetadata()['ShipmentStatus']['choices'];

        foreach ($choices as $choice) {
            $request->InboundShipmentHeader->ShipmentStatus = $choice;

            $serialized = $serializer->serialize($request);
            $expected['InboundShipmentHeader.ShipmentStatus'] = $choice;

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }

        // Check for null.
        $request->InboundShipmentHeader->ShipmentStatus = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.ShipmentStatus']);

        $this->assertSame($serialized, $expected);

        // Check for invalid.
        $request->InboundShipmentHeader->ShipmentStatus = 'NOT_A_VALUE';
        $serialized = $serializer->serialize($request);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentHeader.IntendedBoxContentsSource
     */
    public function test_CreateInboundShipment_InboundShipmentHeader_IntendedBoxContentsSource()
    {
        $serializer = new Serializer;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentHeader = new Entity\InboundShipmentHeader;
        $expected = ['Action' => 'CreateInboundShipment'];

        $choices = $request->InboundShipmentHeader->getMetadata()['IntendedBoxContentsSource']['choices'];

        foreach ($choices as $choice) {
            $request->InboundShipmentHeader->IntendedBoxContentsSource = $choice;

            $serialized = $serializer->serialize($request);
            $expected['InboundShipmentHeader.IntendedBoxContentsSource'] = $choice;

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }

        // Check for null.
        $request->InboundShipmentHeader->IntendedBoxContentsSource = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentHeader.IntendedBoxContentsSource']);

        $this->assertSame($serialized, $expected);

        // Check for invalid.
        $request->InboundShipmentHeader->IntendedBoxContentsSource = 'NOT_A_VALUE';
        $serialized = $serializer->serialize($request);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems.ShipmentId
     */
    public function test_CreateInboundShipment_InboundShipmentItem_ShipmentId()
    {
        $serializer = new Serializer;
        $value = $this->faker->uuid;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = new Entity\InboundShipmentItem;
        $request->InboundShipmentItems->ShipmentId = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentItems.member.1.ShipmentId' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->InboundShipmentItems->ShipmentId = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentItems.member.1.ShipmentId']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems.SellerSKU
     */
    public function test_CreateInboundShipment_InboundShipmentItem_SellerSKU()
    {
        $serializer = new Serializer;
        $value = $this->faker->uuid;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = new Entity\InboundShipmentItem;
        $request->InboundShipmentItems->SellerSKU = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentItems.member.1.SellerSKU' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->InboundShipmentItems->SellerSKU = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentItems.member.1.SellerSKU']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems.FulfillmentNetworkSKU
     */
    public function test_CreateInboundShipment_InboundShipmentItem_FulfillmentNetworkSKU()
    {
        $serializer = new Serializer;
        $value = $this->faker->uuid;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = new Entity\InboundShipmentItem;
        $request->InboundShipmentItems->FulfillmentNetworkSKU = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentItems.member.1.FulfillmentNetworkSKU' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->InboundShipmentItems->FulfillmentNetworkSKU = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentItems.member.1.FulfillmentNetworkSKU']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems.QuantityShipped
     */
    public function test_CreateInboundShipment_InboundShipmentItem_QuantityShipped()
    {
        $serializer = new Serializer;
        $value = $this->faker->randomDigitNotNull;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = new Entity\InboundShipmentItem;
        $request->InboundShipmentItems->QuantityShipped = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentItems.member.1.QuantityShipped' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->InboundShipmentItems->QuantityShipped = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentItems.member.1.QuantityShipped']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems.QuantityReceived
     */
    public function test_CreateInboundShipment_InboundShipmentItem_QuantityReceived()
    {
        $serializer = new Serializer;
        $value = $this->faker->randomDigitNotNull;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = new Entity\InboundShipmentItem;
        $request->InboundShipmentItems->QuantityReceived = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentItems.member.1.QuantityReceived' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->InboundShipmentItems->QuantityReceived = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentItems.member.1.QuantityReceived']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems.QuantityInCase
     */
    public function test_CreateInboundShipment_InboundShipmentItem_QuantityInCase()
    {
        $serializer = new Serializer;
        $value = $this->faker->randomDigitNotNull;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = new Entity\InboundShipmentItem;
        $request->InboundShipmentItems->QuantityInCase = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentItems.member.1.QuantityInCase' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->InboundShipmentItems->QuantityInCase = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentItems.member.1.QuantityInCase']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems.PrepDetailsList.PrepInstruction
     */
    public function test_CreateInboundShipment_InboundShipmentItem_PrepDetailsList_PrepInstruction()
    {
        $serializer = new Serializer;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = new Entity\InboundShipmentItem;
        $request->InboundShipmentItems->PrepDetailsList = new Entity\PrepDetails;
        $expected = ['Action' => 'CreateInboundShipment'];

        $choices = $request->InboundShipmentItems->PrepDetailsList->getMetadata()['PrepInstruction']['choices'];

        foreach ($choices as $choice) {
            $request->InboundShipmentItems->PrepDetailsList->PrepInstruction = $choice;

            $serialized = $serializer->serialize($request);
            $expected['InboundShipmentItems.member.1.PrepDetailsList.member.1.PrepInstruction'] = $choice;

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }

        // Check for null.
        $request->InboundShipmentItems->PrepDetailsList->PrepInstruction = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentItems.member.1.PrepDetailsList.member.1.PrepInstruction']);

        $this->assertSame($serialized, $expected);

        // Check for invalid.
        $request->InboundShipmentItems->PrepDetailsList->PrepInstruction = 'NOT_A_VALUE';
        $serialized = $serializer->serialize($request);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems.PrepDetailsList.PrepOwner
     */
    public function test_CreateInboundShipment_InboundShipmentItem_PrepDetailsList_PrepOwner()
    {
        $serializer = new Serializer;

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = new Entity\InboundShipmentItem;
        $request->InboundShipmentItems->PrepDetailsList = new Entity\PrepDetails;
        $expected = ['Action' => 'CreateInboundShipment'];

        $choices = $request->InboundShipmentItems->PrepDetailsList->getMetadata()['PrepOwner']['choices'];

        foreach ($choices as $choice) {
            $request->InboundShipmentItems->PrepDetailsList->PrepOwner = $choice;

            $serialized = $serializer->serialize($request);
            $expected['InboundShipmentItems.member.1.PrepDetailsList.member.1.PrepOwner'] = $choice;

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }

        // Check for null.
        $request->InboundShipmentItems->PrepDetailsList->PrepOwner = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentItems.member.1.PrepDetailsList.member.1.PrepOwner']);

        $this->assertSame($serialized, $expected);

        // Check for invalid.
        $request->InboundShipmentItems->PrepDetailsList->PrepOwner = 'NOT_A_VALUE';
        $serialized = $serializer->serialize($request);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems.PrepDetailsList (multi)
     */
    public function test_CreateInboundShipment_InboundShipmentItem_PrepDetailsList_multi()
    {
        $serializer = new Serializer;
        $meta = (new Entity\PrepDetails)->getMetadata();

        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = new Entity\InboundShipmentItem;
        $request->InboundShipmentItems->PrepDetailsList = [];

        $expected = [];

        for ($i = 1; $i <= 10; ++$i) {
            $path = sprintf('InboundShipmentItems.member.1.PrepDetailsList.member.%s.', $i);
            $v1 = $this->faker->randomElement($meta['PrepInstruction']['choices']);
            $v2 = $this->faker->randomElement($meta['PrepOwner']['choices']);

            $prep = new Entity\PrepDetails;
            $prep->PrepInstruction = $expected[$path.'PrepInstruction'] = $v1;
            $prep->PrepOwner       = $expected[$path.'PrepOwner']       = $v2;

            $request->InboundShipmentItems->PrepDetailsList[] = $prep;
        }

        $serialized = $serializer->serialize($request);
        $expected['Action'] = 'CreateInboundShipment';

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems.PrepDetailsList (empty)
     */
    public function test_CreateInboundShipment_InboundShipmentItem_PrepDetailsList_empty()
    {
        $serializer = new Serializer;

        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = new Entity\InboundShipmentItem;
        $request->InboundShipmentItems->PrepDetailsList = null;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems.ReleaseDate
     */
    public function test_CreateInboundShipment_InboundShipmentItem_ReleaseDate()
    {
        $serializer = new Serializer;
        $value = $this->faker->dateTimeThisCentury();

        // Check for value.
        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = new Entity\InboundShipmentItem;
        $request->InboundShipmentItems->ReleaseDate = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
            'InboundShipmentItems.member.1.ReleaseDate' => $value->format(Serializer::DATE_FORMAT),
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check with string value.
        $request->InboundShipmentItems->ReleaseDate = $value->format(Serializer::DATE_FORMAT);
        $serialized = $serializer->serialize($request);

        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->InboundShipmentItems->ReleaseDate = '';
        $serialized = $serializer->serialize($request);
        unset($expected['InboundShipmentItems.member.1.ReleaseDate']);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems (multi)
     */
    public function test_CreateInboundShipment_InboundShipmentItems_multi()
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

        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = $items;

        $serialized = $serializer->serialize($request);
        $expected['Action'] = 'CreateInboundShipment';

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test CreateInboundShipment.InboundShipmentItems (empty)
     */
    public function test_CreateInboundShipment_InboundShipmentItems_empty()
    {
        $serializer = new Serializer;

        $request = new Request\CreateInboundShipmentRequest;
        $request->InboundShipmentItems = null;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'CreateInboundShipment',
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
