<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Results;

use SellerWorks\Amazon\MWS\Common\ResultInterface;

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