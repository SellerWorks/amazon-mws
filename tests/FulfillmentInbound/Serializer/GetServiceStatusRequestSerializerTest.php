<?php

namespace SellerWorks\Amazon\Tests\FulfillmentInbound\Serializer;

use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\FulfillmentInbound\Entity;
use SellerWorks\Amazon\FulfillmentInbound\Request;
use SellerWorks\Amazon\FulfillmentInbound\Serializer\Serializer;

/**
 * Serializer tests
 */
class GetServiceStatusRequestSerializerTest extends TestCase
{
    /**
     * Test GetServiceStatusRequest.
     */
    public function test_GetServiceStatusRequest()
    {
        $serializer = new Serializer;
        $request    = new Request\GetServiceStatusRequest;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'GetServiceStatus',
        ];

        ksort($serialized);
        ksort($expected);
        $this->assertSame($serialized, $expected);
    }
}
