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
class GetPrepInstructionsForASINRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test GetPrepInstructionsForASINRequest.ASINList (single)
     */
    public function test_GetPrepInstructionsForASINRequest_ASINList_single()
    {
        $serializer = new Serializer;
        $value = $this->faker->name;

        // Check for value.
        $request = new Request\GetPrepInstructionsForASINRequest;
        $request->ASINList = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'GetPrepInstructionsForASIN',
            'ASINList.Id.1' => $value,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);

        // Check for null.
        $request->ASINList = null;
        $serialized = $serializer->serialize($request);
        unset($expected['ASINList.Id.1']);

        $this->assertSame($serialized, $expected);

        // Check for [].
        $request->ASINList = [];
        $serialized = $serializer->serialize($request);

        $this->assertSame($serialized, $expected);
    }

    /**
     * Test GetPrepInstructionsForASINRequest.ASINList (multiple)
     */
    public function test_GetPrepInstructionsForASINRequest_ASINList_multiple()
    {
        $serializer = new Serializer;
        $expected = [];

        // Check for value.
        $request = new Request\GetPrepInstructionsForASINRequest;
        $request->ASINList = [];

        for ($i = 1; $i <= 50; ++$i) {
            $value = $this->faker->name;
            $request->ASINList[] = $value;
            $expected[sprintf('ASINList.Id.%s', $i)] = $value;
        }

        $serialized = $serializer->serialize($request);
        $expected['Action'] = 'GetPrepInstructionsForASIN';

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test GetPrepInstructionsForASINRequest.ShipToCountryCode
     */
    public function test_GetPrepInstructionsForASINRequest_ShipToCountryCode()
    {
        $serializer = new Serializer;
        $value = $this->faker->countryCode;

        // Check for value.
        $request = new Request\GetPrepInstructionsForASINRequest;
        $request->ShipToCountryCode = $value;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'GetPrepInstructionsForASIN',
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
