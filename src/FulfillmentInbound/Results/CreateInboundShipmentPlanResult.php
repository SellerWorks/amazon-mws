<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Results;

use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * Result object.  Returned by CreateInboundShipmentPlanResponse.
 */
final class CreateInboundShipmentPlanResult implements ResultInterface
{
    /**
     * @var Collection<InboundShipmentPlans>
     */
    public $InboundShipmentPlans;
}