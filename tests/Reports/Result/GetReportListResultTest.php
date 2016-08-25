<?php

namespace SellerWorks\Amazon\Tests\Reports;

use PHPUnit\Framework\TestCase;

use SellerWorks\Amazon\Common\IterableResultInterface;
use SellerWorks\Amazon\Reports\Request;
use SellerWorks\Amazon\Reports\Result;

/**
 * GetReportListResult tests
 */
class GetReportListResultTest extends TestCase
{
    /**
     * Test getNextMethod
     */
    public function test_GetReportListResult_getNextMethod()
    {
        $obj = new Result\GetReportListResult;
        $this->assertTrue($obj instanceof IterableResultInterface);
        $this->assertTrue(method_exists($obj, 'getNextMethod'));
        $this->assertTrue($obj->getNextMethod() == 'GetReportListByNextToken');
    }

    /**
     * Test getNextRequest
     */
    public function test_GetReportListResult_getNextRequest()
    {
        $obj = new Result\GetReportListResult;
        $this->assertTrue(method_exists($obj, 'getNextRequest'));
        $this->assertTrue(is_null($obj->getNextRequest()));

        $obj->NextToken = uniqid();
        $this->assertTrue($obj->getNextRequest() instanceof Request\GetReportListByNextTokenRequest);
        $this->assertEquals($obj->getNextRequest()->NextToken, $obj->NextToken);
    }

    /**
     * Test getRecords
     */
    public function test_GetReportListResult_getRecords()
    {
        $obj = new Result\GetReportListResult;
        $this->assertTrue(method_exists($obj, 'getRecords'));
        $this->assertEquals($obj->getRecords(), []);
    }
}
