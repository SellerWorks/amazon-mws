<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 * Result object.  Returned by CreateInboundShipmentPlanResponse.
 */
final class CreateInboundShipmentPlanResult
{
    /**
     * @var Collection<InboundShipmentPlans>
     */
    public $InboundShipmentPlans;
}