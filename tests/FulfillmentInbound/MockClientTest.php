<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\FulfillmentInbound;

use Error;
use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\FulfillmentInbound\MockClient;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Results;
use SellerWorks\Amazon\MWS\Common\Entities\ResponseMetadata;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * MockClient tests
 */
class MockClientTest extends TestCase
{
    /**
     * Test Error
     */
    public function test_Error()
    {
        $this->expectException(Error::class);

        $client   = new MockClient;
        $response = $client->Error();
    }

    /**
     * Test createInboundShipmentPlan.
     */
    public function test_createInboundShipmentPlan()
    {
        $client   = new MockClient;
        $response = $client->CreateInboundShipmentPlan(new Requests\CreateInboundShipmentPlanRequest);

        $this->assertTrue($response instanceof ResultInterface);
    }
}