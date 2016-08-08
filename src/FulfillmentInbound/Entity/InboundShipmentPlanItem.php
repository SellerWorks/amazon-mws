<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Item information used to create an inbound shipment. Returned by the CreateInboundShipmentPlan operation.
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
     * @var Array<PrepDetails>
     */
    public $PrepDetailsList;
}
