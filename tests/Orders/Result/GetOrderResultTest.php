<?php

namespace SellerWorks\Amazon\Tests\Orders;

use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Orders\Request;
use SellerWorks\Amazon\Orders\Result;

/**
 * GetOrderResult tests
 */
class GetOrderResultTest extends TestCase
{
    /**
     * Test getNextMethod
     */
    public function test_GetOrderResult_getNextMethod()
    {
        $obj = new Result\GetOrderResult;
        $this->assertTrue($obj instanceof IterableResultInterface);
        $this->assertTrue(method_exists($obj, 'getNextMethod'));
        $this->assertTrue($obj->getNextMethod() == 'none');
    }

    /**
     * Test getNextRequest
     */
    public function test_GetOrderResult_getNextRequest()
    {
        $obj = new Result\GetOrderResult;
        $this->assertTrue(method_exists($obj, 'getNextRequest'));
        $this->assertTrue(is_null($obj->getNextRequest()));
    }

    /**
     * Test getRecords
     */
    public function test_GetOrderResult_getRecords()
    {
        $obj = new Result\GetOrderResult;
        $this->assertTrue(method_exists($obj, 'getRecords'));
        $this->assertEquals($obj->getRecords(), []);
    }
}
