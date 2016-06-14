<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\Common\Responses;

use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\Common\Responses;
use SellerWorks\Amazon\MWS\Common\Results;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * GetServiceStatusResponse tests
 */
class GetServiceStatusResponseTest extends TestCase
{
    /**
     * Test getResult
     */
    public function test_getResult()
    {
        $obj = new Responses\GetServiceStatusResponse;
        $obj->GetServiceStatusResult = new Results\GetServiceStatusResult;
        $obj->GetServiceStatusResult->Status = 'GREEN';
        $obj->GetServiceStatusResult->Timestamp = '1969-07-21T02:56:03Z';

        $this->assertTrue($obj->getResult() instanceof ResultInterface);
        $this->assertSame($obj->getResult(), $obj->GetServiceStatusResult);
    }
}