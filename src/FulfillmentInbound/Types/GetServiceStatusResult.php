<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 * Result object.
 */
final class GetServiceStatusResult
{
    /**
	 * @var string
     */
    public $Status;

    /**
	 * @var DateTimeInterface
     */
    public $Timestamp;
}