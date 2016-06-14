<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\FulfillmentInbound\Results;

use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Results;
use SellerWorks\Amazon\MWS\Common\Entities\ResponseMetadata;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * ListInboundShipmentsResult tests
 */
class ListInboundShipmentsResultTest extends TestCase
{
    /**
     * Test creation.
     */
    public function test_create()
    {
        $NextToken = 'Next Token String';
        $Records = ['Record1', 'Record2'];

        $obj = new Results\ListInboundShipmentsResult;
        $obj->NextToken = $NextToken;
        $obj->ShipmentData = $Records;

        $this->assertEquals($obj->getRecords(), $Records);
        $this->assertEquals($obj->getMethod(), 'ListInboundShipmentsByNextToken');
        $this->assertEquals($obj->getNextToken(), $NextToken);
    }
}