<?php

namespace SellerWorks\Amazon\Reports\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * GetReportRequestList result.
 */
final class GetReportRequestListResult implements ResultInterface
{
    /**
     * @var string
     */
    public $NextToken;

    /**
     * @var boolean
     */
    public $HasNext;

    /**
     * @var ReportRequestInfo
     */
    public $ReportRequestInfo;
}
