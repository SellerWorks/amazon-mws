<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * The fees for Amazon to prep goods for shipment.
 */
final class AmazonPrepFeesDetails
{
    /**
     * @var string
     */
    public $PrepInstruction;

    /**
     * @var Amount
     */
    public $FeePerUnit;
}
