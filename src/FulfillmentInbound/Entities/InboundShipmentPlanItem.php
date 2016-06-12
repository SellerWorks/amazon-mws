<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;

/**
 * Item information used to create an inbound shipment. Returned by the CreateInboundShipmentPlan operation.
 */
final class InboundShipmentPlanItem
{
    /**
     * @var string
     */
    public $SellerSKU;

    /**
     * @var string
     */
    public $FulfillmentNetworkSKU;

    /**
     * @var int
     */
    public $Quantity;

    /**
     * @var Collection<PrepDetails>
     */
    public $PrepDetailsList;
}