<?php

namespace SellerWorks\Amazon\Reports\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * CancelReportRequests result.
 */
final class CancelReportRequestsResult implements ResultInterface
{
    /**
     * @var int
     */
    public $Count;

    /**
     * @var Array<ReportRequestInfo>
     */
    public $ReportRequestInfo;
}
