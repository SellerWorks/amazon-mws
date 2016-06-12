<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;

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