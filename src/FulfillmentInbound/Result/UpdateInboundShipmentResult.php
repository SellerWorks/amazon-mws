<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * UpdateInboundShipment result object.
 */
final class UpdateInboundShipmentResult implements ResultInterface
{
    /**
     * @var string
     */
    public $ShipmentId;
}
