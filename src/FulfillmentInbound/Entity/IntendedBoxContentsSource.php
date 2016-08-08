<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Item information for creating an inbound shipment plan. Submitted with a call to the CreateInboundShipmentPlan
 * operation.
 */
final class IntendedBoxContentsSource
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
     * @var Array<PrepDetails>
     */
    public $PrepDetailsList;
}
