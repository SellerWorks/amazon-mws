<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;

/**
 * 
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
     * @var Array<PrepDetails>
     */
    public $PrepDetailsList;
}