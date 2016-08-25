<?php

namespace SellerWorks\Amazon\Reports\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * GetReportCount result.
 */
final class GetReportCountResult implements ResultInterface
{
    /**
     * @var int
     */
    public $Count;
}
