<?php

namespace SellerWorks\Amazon\Common\Result;

use SellerWorks\Amazon\Common\ResultInterface;

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