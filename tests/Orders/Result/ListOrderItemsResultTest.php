<?php

namespace SellerWorks\Amazon\Tests\Orders;

use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Orders\Request;
use SellerWorks\Amazon\Orders\Result;

/**
 * ListOrderItemsResult tests
 */
class ListOrderItemsResultTest extends TestCase
{
    /**
     * Test getNextMethod
     */
    public function test_ListOrderItemsResult_getNextMethod()
    {
        $obj = new Result\ListOrderItemsResult;
        $this->assertTrue($obj instanceof IterableResultInterface);
        $this->assertTrue(method_exists($obj, 'getNextMethod'));
        $this->assertTrue($obj->getNextMethod() == 'ListOrderItemsByNextToken');
    }

    /**
     * Test getNextRequest
     */
    public function test_ListOrderItemsResult_getNextRequest()
    {
        $obj = new Result\ListOrderItemsResult;
        $this->assertTrue(method_exists($obj, 'getNextRequest'));
        $this->assertTrue(is_null($obj->getNextRequest()));

        $obj->NextToken = uniqid();
        $this->assertTrue($obj->getNextRequest() instanceof Request\ListOrderItemsByNextTokenRequest);
        $this->assertEquals($obj->getNextRequest()->NextToken, $obj->NextToken);
    }

    /**
     * Test getRecords
     */
    public function test_ListOrderItemsResult_getRecords()
    {
        $obj = new Result\ListOrderItemsResult;
        $this->assertTrue(method_exists($obj, 'getRecords'));
        $this->assertEquals($obj->getRecords(), []);
    }
}
