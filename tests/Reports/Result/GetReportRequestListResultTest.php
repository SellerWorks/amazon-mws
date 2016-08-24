<?php

namespace SellerWorks\Amazon\Tests\Reports;

use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Reports\Request;
use SellerWorks\Amazon\Reports\Result;

/**
 * ListOrdersResult tests
 */
class GetReportRequestListResultTest extends TestCase
{
    /**
     * Test getNextMethod
     */
    public function test_GetReportRequestListResult_getNextMethod()
    {
        $obj = new Result\GetReportRequestListResult;
        $this->assertTrue($obj instanceof IterableResultInterface);
        $this->assertTrue(method_exists($obj, 'getNextMethod'));
        $this->assertTrue($obj->getNextMethod() == 'GetReportRequestListByNextToken');
    }

    /**
     * Test getNextRequest
     */
    public function test_GetReportRequestListResult_getNextRequest()
    {
        $obj = new Result\GetReportRequestListResult;
        $this->assertTrue(method_exists($obj, 'getNextRequest'));
        $this->assertTrue(is_null($obj->getNextRequest()));

        $obj->NextToken = uniqid();
        $this->assertTrue($obj->getNextRequest() instanceof Request\GetReportRequestListByNextTokenRequest);
        $this->assertEquals($obj->getNextRequest()->NextToken, $obj->NextToken);
    }

    /**
     * Test getRecords
     */
    public function test_GetReportRequestListResult_getRecords()
    {
        $obj = new Result\GetReportRequestListResult;
        $this->assertTrue(method_exists($obj, 'getRecords'));
        $this->assertEquals($obj->getRecords(), []);
    }
}
