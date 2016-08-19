<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * An invalid ASIN and the reason it is invalid.
 */
final class InvalidASIN
{
    /**
     * @var string
     */
    public $ASIN;

    /**
     * @var string
     */
    public $ErrorReason;
}
