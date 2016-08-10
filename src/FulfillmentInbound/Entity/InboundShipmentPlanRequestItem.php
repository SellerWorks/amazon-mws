<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * How the seller intends to provide box contents information for a shipment.
 */
final class InboundShipmentPlanRequestItem
{
    /**
     * @var string
     */
    public $SellerSKU;

    /**
     * @var string
     */
    public $ASIN;

    /**
     * @var string
     */
    public $Condition;

    /**
     * @var int
     */
    public $Quantity;

    /**
     * @var int
     */
    public $QuantityInCase;

    /**
     * @var PrepDetailsList
     */
    public $PrepDetailsList;
}
