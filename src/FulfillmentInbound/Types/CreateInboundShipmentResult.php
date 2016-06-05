<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 * Result object.  Returned by CreateInboundShipmentPlanResponse.
 */
final class CreateInboundShipmentResult
{
    /**
     * @var string
     */
    public $ShipmentId;
}