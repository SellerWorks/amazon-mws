<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\FulfillmentInbound\Responses;

use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Results;
use SellerWorks\Amazon\MWS\Common\Entities\ResponseMetadata;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * GetPrepInstructionsForSKUResponse tests
 */
class GetPrepInstructionsForSKUResponseTest extends TestCase
{
    /**
     * Test getResult
     */
    public function test_getResult()
    {
        $obj = new Responses\GetPrepInstructionsForSKUResponse;
        $obj->ResponseMetadata = new ResponseMetadata;
        $obj->ResponseMetadata->RequestId = '982a45cf-af8c-42a7-bfeb-589317e86bc1';

        $obj->GetPrepInstructionsForSKUResult = new Results\GetPrepInstructionsForSKUResult;

        $this->assertTrue($obj->getResult() instanceof ResultInterface);
        $this->assertSame($obj->getResult(), $obj->GetPrepInstructionsForSKUResult);
    }
}