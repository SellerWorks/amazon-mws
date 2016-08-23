<?php

namespace SellerWorks\Amazon\Reports;

use SellerWorks\Amazon\Common\RecordIterator;

/**
 * Implements the plumbing methods of ReportsInterface.
 */
trait ReportsTrait
{
    /**
     * @param  RequestReportRequest  $request
     * @return RequestReportResult
     */
    function RequestReport(Request\RequestReportRequest $request)
    {
        return $this->RequestReportAsync($request)->wait();
    }

    /**
     * @param  RequestReportRequest  $request
     * @return PromiseInterface
     */
    public function RequestReportAsync(Request\RequestReportRequest $request)
    {
        return $this->send($request, 10);
    }
}
