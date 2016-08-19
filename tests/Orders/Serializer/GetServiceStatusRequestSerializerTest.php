<?php

namespace SellerWorks\Amazon\Tests\Orders\Serializer;

use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Orders\Entity;
use SellerWorks\Amazon\Orders\Request;
use SellerWorks\Amazon\Orders\Serializer\Serializer;

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
