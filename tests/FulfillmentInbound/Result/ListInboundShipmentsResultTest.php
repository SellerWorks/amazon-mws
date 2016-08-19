<?php

namespace SellerWorks\Amazon\Tests\FulfillmentInbound;

use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\FulfillmentInbound\Request;
use SellerWorks\Amazon\FulfillmentInbound\Result;

/**
 * ListInboundShipmentsResult tests
 */
class ListInboundShipmentsResultTest extends TestCase
{
    /**
     * Test getNextMethod
     */
    public function test_ListInboundShipmentsResult_getNextMethod()
    {
        $obj = new Result\ListInboundShipmentsResult;
        $this->assertTrue($obj instanceof IterableResultInterface);
        $this->assertTrue(method_exists($obj, 'getNextMethod'));
        $this->assertTrue($obj->getNextMethod() == 'ListInboundShipmentsByNextToken');
    }

    /**
     * Test getNextRequest
     */
    public function test_ListInboundShipmentsResult_getNextRequest()
    {
        $obj = new Result\ListInboundShipmentsResult;
        $this->assertTrue(method_exists($obj, 'getNextRequest'));
        $this->assertTrue(is_null($obj->getNextRequest()));

        $obj->NextToken = uniqid();
        $this->assertTrue($obj->getNextRequest() instanceof Request\ListInboundShipmentsByNextTokenRequest);
        $this->assertEquals($obj->getNextRequest()->NextToken, $obj->NextToken);
    }

    /**
     * Test getRecords
     */
    public function test_ListInboundShipmentsResult_getRecords()
    {
        $obj = new Result\ListInboundShipmentsResult;
        $this->assertTrue(method_exists($obj, 'getRecords'));
        $this->assertEquals($obj->getRecords(), []);
    }
}
