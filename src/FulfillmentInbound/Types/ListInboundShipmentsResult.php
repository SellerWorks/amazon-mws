<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 * Results of ListInboundShipments and ListInboundShipmentsByNextToken
 */
final class ListInboundShipmentsResult
{
    /**
     * @var  string
     */
    public $NextToken;

    /**
     * @var  InboundShipmentInfo
     */
    public $ShipmentData;
}