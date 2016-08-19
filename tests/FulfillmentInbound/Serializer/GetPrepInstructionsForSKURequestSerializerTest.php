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
class GetPrepInstructionsForSKURequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test GetPrepInstructionsForSKURequest.SellerSKUList (single)
     */
    public function test_GetPrepInstructionsForSKURequest_SellerSKUList_single()
    {
        $serializer = new Serializer;
        $value = $this->faker->name;

        // Check for value.
        $request = new Request\GetPrepInstructionsForSKURequest;
        $request->SellerSKUList = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'GetPrepInstructionsForSKU',
            'SellerSKUList.Id.1' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->SellerSKUList = null;
        $serialized = $serializer->serialize($request);
        unset($expected['SellerSKUList.Id.1']);

        $this->assertSame($serialized, $expected);

        // Check for [].
        $request->SellerSKUList = [];
        $serialized = $serializer->serialize($request);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test GetPrepInstructionsForSKURequest.SellerSKUList (multiple)
     */
    public function test_GetPrepInstructionsForSKURequest_SellerSKUList_multiple()
    {
        $serializer = new Serializer;
        $expected = [];

        // Check for value.
        $request = new Request\GetPrepInstructionsForSKURequest;
        $request->SellerSKUList = [];

        for ($i = 1; $i <= 50; ++$i) {
            $value = $this->faker->name;
            $request->SellerSKUList[] = $value;
            $expected[sprintf('SellerSKUList.Id.%s', $i)] = $value;
        }

        $serialized = $serializer->serialize($request);
        $expected['Action'] = 'GetPrepInstructionsForSKU';

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test GetPrepInstructionsForSKURequest.ShipToCountryCode
     */
    public function test_GetPrepInstructionsForSKURequest_ShipToCountryCode()
    {
        $serializer = new Serializer;
        $value = $this->faker->countryCode;

        // Check for value.
        $request = new Request\GetPrepInstructionsForSKURequest;
        $request->ShipToCountryCode = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'GetPrepInstructionsForSKU',
            'ShipToCountryCode' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->ShipToCountryCode = '';
        $serialized = $serializer->serialize($request);
        unset($expected['ShipToCountryCode']);

        $this->assertSame($serialized, $expected);
    }
}
