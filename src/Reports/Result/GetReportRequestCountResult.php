<?php

namespace SellerWorks\Amazon\Reports\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * GetReportRequestCount result.
 */
final class GetReportRequestCountResult implements ResultInterface
{
    /**
     * @var int
     */
    public $Count;
}
