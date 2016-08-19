<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * The estimated shipping cost for a shipment using an Amazon-partnered carrier.
 */
final class PartneredEstimate
{
    /**
     * @var Amount
     */
    public $Amount;

    /**
     * @var string
     */
    public $ConfirmDeadline;

    /**
     * @var string
     */
    public $VoidDeadline;
}
