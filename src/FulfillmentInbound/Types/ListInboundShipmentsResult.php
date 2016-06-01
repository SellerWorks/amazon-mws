<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 * Result object.  Returned by ListInboundShipmentsResponse.
 */
final class ListInboundShipmentsResult
{
    /**
     * @var  string
     */
    public $NextToken;

    /**
     * @var  Array<InboundShipmentInfo>
     */
    public $ShipmentData;
}