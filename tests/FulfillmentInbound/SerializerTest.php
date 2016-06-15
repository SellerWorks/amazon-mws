<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\FulfillmentInbound;

use Error;
use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\Common\Requests\GetServiceStatusRequest;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Results;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Serializer;

/**
 * Serializer tests
 */
class SerializerTest extends TestCase
{
    /**
     * Test Error
     */
    public function test_serialize_GetServiceStatus()
    {
        $request  = new GetServiceStatusRequest;
        $expected = [
            'Action' => 'GetServiceStatus',
        ];

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     * Test Error
     */
    public function test_serialize_CreateInboundShipmentPlan()
    {
        $request  = new CreateInboundShipmentPlan;
        $expected = [
            'Action' => 'GetServiceStatus',
        ];

        $serializer = new Serializer;
        $actual = $serializer->serialize($request);

        ksort($expected);
        ksort($actual);
        $this->assertEquals($expected, $actual);
    }
}