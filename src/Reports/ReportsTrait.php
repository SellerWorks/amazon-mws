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
        return $this->send($request, 60);
    }

    /**
     * @param  GetReportRequestListRequest  $request
     * @return GetReportRequestListResult
     */
    function GetReportRequestList(Request\GetReportRequestListRequest $request)
    {
        return $this->GetReportRequestListAsync($request)->wait();
    }

    /**
     * @param  GetReportRequestListRequest  $request
     * @return PromiseInterface
     */
    public function GetReportRequestListAsync(Request\GetReportRequestListRequest $request)
    {
        return $this->send($request, 60);
    }

    /**
     * @param  GetReportRequestListByNextTokenRequest  $request
     * @return GetReportRequestListResult
     */
    function GetReportRequestListByNextToken(Request\GetReportRequestListByNextTokenRequest $request)
    {
        return $this->GetReportRequestListByNextTokenAsync($request)->wait();
    }

    /**
     * @param  GetReportRequestListByNextTokenRequest  $request
     * @return PromiseInterface
     */
    public function GetReportRequestListByNextTokenAsync(Request\GetReportRequestListByNextTokenRequest $request)
    {
        return $this->send($request, 60);
    }

    /**
     * @param  GetReportRequestCountRequest  $request
     * @return GetReportRequestCountResult
     */
    function GetReportRequestCount(Request\GetReportRequestCountRequest $request)
    {
        return $this->GetReportRequestCountAsync($request)->wait();
    }

    /**
     * @param  GetReportRequestCountRequest  $request
     * @return PromiseInterface
     */
    public function GetReportRequestCountAsync(Request\GetReportRequestCountRequest $request)
    {
        return $this->send($request, 60);
    }

    /**
     * @param  CancelReportRequestsRequest  $request
     * @return CancelReportRequestsResult
     */
    function CancelReportRequests(Request\CancelReportRequestsRequest $request)
    {
        return $this->CancelReportRequestsAsync($request)->wait();
    }

    /**
     * @param  CancelReportRequestsRequest  $request
     * @return PromiseInterface
     */
    public function CancelReportRequestsAsync(Request\CancelReportRequestsRequest $request)
    {
        return $this->send($request, 60);
    }

    /**
     * @param  GetReportListRequest  $request
     * @return GetReportListResult
     */
    function GetReportList(Request\GetReportListRequest $request)
    {
        return $this->GetReportListAsync($request)->wait();
    }

    /**
     * @param  GetReportListRequest  $request
     * @return PromiseInterface
     */
    public function GetReportListAsync(Request\GetReportListRequest $request)
    {
        return $this->send($request, 60);
    }

    /**
     * @param  GetReportListByNextTokenRequest  $request
     * @return GetReportListByNextTokenResult
     */
    public function GetReportListByNextToken(Request\GetReportListByNextTokenRequest $request)
    {
        return $this->GetReportListByNextTokenAsync($request)->wait();
    }

    /**
     * @param  GetReportListByNextTokenRequest  $request
     * @return PromiseInterface
     */
    public function GetReportListByNextTokenAsync(Request\GetReportListByNextTokenRequest $request)
    {
        return $this->send($request, 60);
    }
}
