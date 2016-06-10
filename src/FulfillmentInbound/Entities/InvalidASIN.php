<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
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