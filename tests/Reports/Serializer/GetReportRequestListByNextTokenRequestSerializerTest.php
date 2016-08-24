<?php

namespace SellerWorks\Amazon\Tests\Reports\Serializer;

use DateTime;
use Faker;
use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Reports\Entity;
use SellerWorks\Amazon\Reports\Request;
use SellerWorks\Amazon\Reports\Serializer\Serializer;

/**
 * Serializer tests
 */
class GetReportRequestListByNextTokenRequestSerializerTest extends TestCase
{
    private $faker;

    public function setUp()
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * Test GetReportRequestListByNextTokenRequest.NextToken
     */
    public function test_GetReportRequestListByNextTokenRequest_NextToken()
    {
        $serializer = new Serializer;

        $request = new Request\GetReportRequestListByNextTokenRequest;
        $request->NextToken = $this->faker->uuid;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action'    => 'GetReportRequestListByNextToken',
            'NextToken' => $request->NextToken,
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
