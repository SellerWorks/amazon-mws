<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\Common\Responses;

use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\Common\Responses;
use SellerWorks\Amazon\MWS\Common\Results;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * ErrorResponse tests
 */
class ErrorResponseTest extends TestCase
{
    /**
     * Test getResult
     */
    public function test_getResult()
    {
        $obj = new Responses\ErrorResponse;
        $obj->RequestID = '982a45cf-af8c-42a7-bfeb-589317e86bc1';
        $obj->Error = new Results\Error;
        $obj->Error->Type    = 'Sender';
        $obj->Error->Code    = 'SignatureDoesNotMatch';
        $obj->Error->Message = 'The request signature we calculated does not match the signature you provided.';

        $this->assertTrue($obj->getResult() instanceof ResultInterface);
        $this->assertSame($obj->getResult(), $obj->Error);
    }
}