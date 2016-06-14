<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Tests\FulfillmentInbound\Requests;

use DateTime;
use PHPUnit\Framework\TestCase;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Requests\ListInboundShipmentItemsRequest;

/**
 * Passport tests.
 */
class ListInboundShipmentItemsRequestTest extends TestCase
{
    /**
     * Test creating a Passport object, and that it returns all values.
     */
    public function testCreate()
    {
        // Setup vars.
        $ShipmentId        = 'Shipment Id';
        $LastUpdatedAfter  = new DateTime('2016-01-01');
        $LastUpdatedBefore = new DateTime('2016-02-01');

        // Create by properties.
        $byProp = new ListInboundShipmentItemsRequest;
        $byProp->ShipmentId = $ShipmentId;
        $byProp->LastUpdatedAfter  = $LastUpdatedAfter;
        $byProp->LastUpdatedBefore = $LastUpdatedBefore;

        // Create by constructor.
        $byConstruct = new ListInboundShipmentItemsRequest($ShipmentId, $LastUpdatedAfter, $LastUpdatedBefore);

        // Assertions.
        $this->assertEquals($byProp->ShipmentId, $byConstruct->ShipmentId);
        $this->assertEquals($byProp->LastUpdatedAfter, $byConstruct->LastUpdatedAfter);
        $this->assertEquals($byProp->LastUpdatedBefore, $byConstruct->LastUpdatedBefore);
    }
}