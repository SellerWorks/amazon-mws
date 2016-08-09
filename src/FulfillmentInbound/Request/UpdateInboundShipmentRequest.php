<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Updates an existing inbound shipment.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_UpdateInboundShipment.html
 */
final class UpdateInboundShipmentRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $ShipmentId;

    /**
     * @var InboundShipmentHeader
     */
    public $InboundShipmentHeader;

    /**
     * @var Array<InboundShipmentItem>
     */
    public $InboundShipmentItems;
}
