<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns a list of items in a specified inbound shipment, or a list of items that were updated within a specified time
 * frame.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItems.html
 */
final class ListInboundShipmentItemsRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $ShipmentId;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedAfter;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedBefore;
}
