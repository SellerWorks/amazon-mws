<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common\Results;

use SellerWorks\Amazon\MWS\Common\ResultInterface;

/**
 * GetServiceStatus result object.
 */
final class GetServiceStatusResult implements ResultInterface
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