<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\Common\Responses;

use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\Common\Responses;
use SellerWorks\Amazon\MWS\Common\Results;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * NullResponse tests
 */
class NullResponseTest extends TestCase
{
    /**
     * Test getResult
     */
    public function test_getResult()
    {
        $obj = new Responses\NullResponse;
        $obj->Result = new Results\NullResult;

        $this->assertTrue($obj->getResult() instanceof ResultInterface);
        $this->assertSame($obj->Result, $obj->getResult());
    }
}