<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * CreateInboundShipmentPlan result object.
 */
final class CreateInboundShipmentPlanResult implements ResultInterface
{
    /**
     * @var Array<InboundShipmentPlans>
     */
    public $InboundShipmentPlans;
}
