<?php

namespace SellerWorks\Amazon\Tests\FulfillmentInbound;

use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\FulfillmentInbound\Request;
use SellerWorks\Amazon\FulfillmentInbound\Result;

/**
 * ListInboundShipmentItemsResult tests
 */
class ListInboundShipmentItemsResultTest extends TestCase
{
    /**
     * Test getNextMethod
     */
    public function test_ListInboundShipmentItemsResult_getNextMethod()
    {
        $obj = new Result\ListInboundShipmentItemsResult;
        $this->assertTrue($obj instanceof IterableResultInterface);
        $this->assertTrue(method_exists($obj, 'getNextMethod'));
        $this->assertTrue($obj->getNextMethod() == 'ListInboundShipmentItemsByNextToken');
    }

    /**
     * Test getNextRequest
     */
    public function test_ListInboundShipmentItemsResult_getNextRequest()
    {
        $obj = new Result\ListInboundShipmentItemsResult;
        $this->assertTrue(method_exists($obj, 'getNextRequest'));
        $this->assertTrue(is_null($obj->getNextRequest()));

        $obj->NextToken = uniqid();
        $this->assertTrue($obj->getNextRequest() instanceof Request\ListInboundShipmentItemsByNextTokenRequest);
        $this->assertEquals($obj->getNextRequest()->NextToken, $obj->NextToken);
    }

    /**
     * Test getRecords
     */
    public function test_ListInboundShipmentItemsResult_getRecords()
    {
        $obj = new Result\ListInboundShipmentItemsResult;
        $this->assertTrue(method_exists($obj, 'getRecords'));
        $this->assertEquals($obj->getRecords(), []);
    }
}
