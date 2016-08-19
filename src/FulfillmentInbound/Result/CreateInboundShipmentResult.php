<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * Result object.  Returned by CreateInboundShipmentPlanResponse.
 */
final class CreateInboundShipmentResult implements ResultInterface
{
    /**
     * @var string
     */
    public $ShipmentId;
}
