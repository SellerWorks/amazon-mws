<?php

namespace SellerWorks\Amazon\Tests\Orders;

use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Orders\Request;
use SellerWorks\Amazon\Orders\Result;

/**
 * ListOrdersResult tests
 */
class ListOrdersResultTest extends TestCase
{
    /**
     * Test getNextMethod
     */
    public function test_ListOrdersResult_getNextMethod()
    {
        $obj = new Result\ListOrdersResult;
        $this->assertTrue($obj instanceof IterableResultInterface);
        $this->assertTrue(method_exists($obj, 'getNextMethod'));
        $this->assertTrue($obj->getNextMethod() == 'ListOrdersByNextToken');
    }

    /**
     * Test getNextRequest
     */
    public function test_ListOrdersResult_getNextRequest()
    {
        $obj = new Result\ListOrdersResult;
        $this->assertTrue(method_exists($obj, 'getNextRequest'));
        $this->assertTrue(is_null($obj->getNextRequest()));

        $obj->NextToken = uniqid();
        $this->assertTrue($obj->getNextRequest() instanceof Request\ListOrdersByNextTokenRequest);
        $this->assertEquals($obj->getNextRequest()->NextToken, $obj->NextToken);
    }

    /**
     * Test getRecords
     */
    public function test_ListOrdersResult_getRecords()
    {
        $obj = new Result\ListOrdersResult;
        $this->assertTrue(method_exists($obj, 'getRecords'));
        $this->assertEquals($obj->getRecords(), []);
    }
}
