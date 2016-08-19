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
class ListOrderItemsRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test ListOrderItemsRequest.
     */
    public function test_ListOrderItemsRequest()
    {
        $serializer = new Serializer;

        $request = new Request\ListOrderItemsRequest;
        $request->AmazonOrderId = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action'        => 'ListOrderItems',
            'AmazonOrderId' => $request->AmazonOrderId,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
