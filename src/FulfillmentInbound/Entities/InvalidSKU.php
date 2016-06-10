<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
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