<?php

namespace SellerWorks\Amazon\Tests\Orders\Serializer;

use Faker;
use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Orders\Entity;
use SellerWorks\Amazon\Orders\Request;
use SellerWorks\Amazon\Orders\Serializer\Serializer;

/**
 * Serializer tests
 */
class GetOrderRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test GetOrderRequest.AmazonOrderId as strings
     */
    public function test_GetOrderRequest_AmazonOrderId_as_scalar()
    {
        $serializer = new Serializer;

        $request = new Request\GetOrderRequest;
        $request->AmazonOrderId = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected   = [
            'Action'             => 'GetOrder',
            'AmazonOrderId.Id.1' => $request->AmazonOrderId,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }

    /**
     * Test GetOrderRequest.AmazonOrderId as an array
     */
    public function test_GetOrderRequest_AmazonOrderId_as_array()
    {
        $serializer = new Serializer;

        $values = [
            'AmazonOrderId.Id.1' => $this->faker->uuid,
            'AmazonOrderId.Id.2' => $this->faker->uuid,
            'AmazonOrderId.Id.3' => $this->faker->uuid,
            'AmazonOrderId.Id.4' => $this->faker->uuid,
            'AmazonOrderId.Id.5' => $this->faker->uuid,
            'AmazonOrderId.Id.6' => $this->faker->uuid,
            'AmazonOrderId.Id.7' => $this->faker->uuid,
            'AmazonOrderId.Id.8' => $this->faker->uuid,
            'AmazonOrderId.Id.9' => $this->faker->uuid,
        ];

        $request = new Request\GetOrderRequest;
        $request->AmazonOrderId = array_values($values);

        $serialized = $serializer->serialize($request);
        $expected   = ['Action' => 'GetOrder'] + $values;

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
