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
class ListOrderItemsByNextTokenRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test ListOrderItemsByNextTokenRequest.
     */
    public function test_ListOrderItemsByNextTokenRequest()
    {
        $serializer = new Serializer;

        $request = new Request\ListOrderItemsByNextTokenRequest;
        $request->NextToken = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action'    => 'ListOrderItemsByNextToken',
            'NextToken' => $request->NextToken,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
