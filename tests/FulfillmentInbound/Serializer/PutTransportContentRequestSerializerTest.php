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
class PutTransportContentRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test PutTransportContentRequest.ShipmentId
     */
    public function test_PutTransportContentRequest_ShipmentId()
    {
        $serializer = new Serializer;
        $value = $this->faker->uuid;

        // Check for value.
        $request = new Request\PutTransportContentRequest;
        $request->ShipmentId = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'PutTransportContent',
            'ShipmentId' => $value,
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
     * Test PutTransportContentRequest.IsPartnered
     */
    public function test_PutTransportContentRequest_IsPartnered()
    {
        $serializer = new Serializer;

        // Check for boolean true.
        $request = new Request\PutTransportContentRequest;
        $request->IsPartnered = true;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'PutTransportContent',
            'IsPartnered' => 'true',
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for string 'TRue'
        $request->IsPartnered = 'TRue';

        $serialized = $serializer->serialize($request);
        ksort($serialized);
        $this->assertSame($serialized, $expected);

        // Check for boolean false.
        $request->IsPartnered = false;
        $expected['IsPartnered'] = 'false';

        $serialized = $serializer->serialize($request);
        ksort($serialized);
        $this->assertSame($serialized, $expected);

        // Check for string 'FaLSe'
        $request->IsPartnered = 'FaLSe';

        $serialized = $serializer->serialize($request);
        ksort($serialized);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test PutTransportContentRequest.ShipmentType
     */
    public function test_PutTransportContentRequest_ShipmentType()
    {
        $serializer = new Serializer;

        // Check for value.
        $request = new Request\PutTransportContentRequest;
        $expected = ['Action' => 'PutTransportContent'];

        $choices = $request->getMetadata()['ShipmentType']['choices'];

        foreach ($choices as $choice) {
            $request->ShipmentType = $choice;

            $serialized = $serializer->serialize($request);
            $expected['ShipmentType'] = $choice;

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }

        // Check for null.
        $request->ShipmentType = '';
        $serialized = $serializer->serialize($request);
        unset($expected['ShipmentType']);

        $this->assertSame($serialized, $expected);

        // Check for invalid.
        $request->ShipmentType = 'NOT_A_VALUE';
        $serialized = $serializer->serialize($request);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test PutTransportContentRequest.TransportDetails.PartneredSmallParcelData.CarrierName
     */
    public function test_PutTransportContentRequest_TransportDetails_PartneredSmallParcelData_CarrierName()
    {
        $serializer = new Serializer;

        // Check for value.
        $request = new Request\PutTransportContentRequest;
        $request->TransportDetails = new Entity\TransportDetailInput;
        $request->TransportDetails->PartneredSmallParcelData = new Entity\PartneredSmallParcelDataInput;
        $expected = ['Action' => 'PutTransportContent'];

        $choices = $request->TransportDetails->PartneredSmallParcelData->getMetadata()['CarrierName']['choices'];

        foreach ($choices as $choice) {
            $request->TransportDetails->PartneredSmallParcelData->CarrierName = $choice;

            $serialized = $serializer->serialize($request);
            $expected['TransportDetails.PartneredSmallParcelData.CarrierName'] = $choice;

            ksort($serialized);
            ksort($expected);
            $this->assertSame($serialized, $expected);
        }

        // Check for null.
        $request->TransportDetails->PartneredSmallParcelData->CarrierName = '';
        $serialized = $serializer->serialize($request);
        unset($expected['TransportDetails.PartneredSmallParcelData.CarrierName']);

        $this->assertSame($serialized, $expected);

        // Check for invalid.
        $request->TransportDetails->PartneredSmallParcelData->CarrierName = 'NOT_A_VALUE';
        $serialized = $serializer->serialize($request);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test PutTransportContentRequest.TransportDetails.PartneredSmallParcelData.PackageList.Dimensions.Unit
     */
    public function test_PutTransportContentRequest_TransportDetails_PartneredSmallParcelData_PackageList_Dimensions_Unit()
    {
    }
}
