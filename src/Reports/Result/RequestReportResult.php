<?php

namespace SellerWorks\Amazon\Reports\Result;

use SellerWorks\Amazon\Common\ResultInterface;

/**
 * RequestReport result object.
 */
final class RequestReportResult implements ResultInterface
{
    /**
     * @var ReportRequestInfo
     */
    public $ReportRequestInfo;
}
