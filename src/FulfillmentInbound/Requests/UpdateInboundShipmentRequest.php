<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;

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
     * @var InboundShipmentItems
     */
    public $InboundShipmentItems;
}