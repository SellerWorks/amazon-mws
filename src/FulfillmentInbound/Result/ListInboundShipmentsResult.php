<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * ListInboundShipments result object.
 */
final class ListInboundShipmentsResult implements ResultInterface
{
    /**
     * @var string
     */
    public $NextToken;

    /**
     * @var Array<InboundShipmentInfo>
     */
    public $ShipmentData;
}
