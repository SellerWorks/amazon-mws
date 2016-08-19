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
class ListOrdersByNextTokenRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test ListOrdersByNextTokenRequest.
     */
    public function test_ListOrdersByNextTokenRequest()
    {
        $serializer = new Serializer;

        $request = new Request\ListOrdersByNextTokenRequest;
        $request->NextToken = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action'    => 'ListOrdersByNextToken',
            'NextToken' => $request->NextToken,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
