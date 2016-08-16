<?php

namespace SellerWorks\Amazon\Tests\FulfillmentInbound\Serializer;

use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\FulfillmentInbound\Entity;
use SellerWorks\Amazon\FulfillmentInbound\Request;
use SellerWorks\Amazon\FulfillmentInbound\Serializer\Serializer;

/**
 * Serializer tests
 */
class BadRequestSerializerTest extends TestCase
{
    /**
     * Test GetServiceStatusRequest.
     */
    public function test_BadRequest()
    {
        if (version_compare(PHP_VERSION, '7.0.0') >= 0) {
            $this->expectException(\Exception::class);
        } else {
            $this->expectException(\PHPUnit_Framework_Error::class);
        }

        $serializer = new Serializer;
        $request    = new BadRequest;

        $serialized = $serializer->serialize($request);
        $expected = [
            'Action' => 'Bad',
        ];
    }
}
