<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * An invalid Seller SKU and the reason it is invalid.
 */
final class InvalidSKU
{
    /**
     * @var string
     */
    public $SellerSKU;

    /**
     * @var string
     */
    public $ErrorReason;
}
