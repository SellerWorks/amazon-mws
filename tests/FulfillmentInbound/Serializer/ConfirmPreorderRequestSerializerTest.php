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
class ConfirmPreorderRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test ConfirmPreorderRequest.ShipmentId
     */
    public function test_ConfirmPreorderRequest_ShipmentId()
    {
        $serializer = new Serializer;

        $request = new Request\ConfirmPreorderRequest;
        $request->ShipmentId = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'ConfirmPreorder',
            'ShipmentId' => $request->ShipmentId,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test ConfirmPreorderRequest.NeedByDate
     */
    public function test_ConfirmPreorderRequest_NeedByDate()
    {
        $serializer = new Serializer;

        $request = new Request\ConfirmPreorderRequest;
        $request->NeedByDate = $this->faker->dateTimeThisCentury();

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'ConfirmPreorder',
            'NeedByDate' => $request->NeedByDate->format(Serializer::DATE_FORMAT),
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
