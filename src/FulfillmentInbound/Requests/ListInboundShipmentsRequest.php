<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;

/**
 * Returns a list of inbound shipments based on criteria that you specify.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipments.html
 */
final class ListInboundShipmentsRequest implements RequestInterface
{
    /**
     * @var Array<string>
     */
    public $ShipmentStatusList;

    /**
     * @var Array<string>
     */
    public $ShipmentIdList;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedAfter;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedBefore;
}