<?php

namespace SellerWorks\Amazon\Reports;

/**
 * Amazon MWS Reports
 *
 * The Reports API section of the Amazon Marketplace Web Service (Amazon MWS) API lets you request various reports that
 * help you manage your Sell on Amazon business. Report types are specified using the ReportTypes enumeration.
 *
 * @url http://docs.developer.amazonservices.com/en_US/reports/
 * @version 2009-01-01
 */
interface ReportsInterface
{
    /**
     * Creates a report request and submits the request to Amazon MWS.
     *
     * @see http://docs.developer.amazonservices.com/en_US/reports/Reports_RequestReport.html
     *
     * @param  RequestReportRequest  $request
     * @return RequestReportResult
     */
    function RequestReport(Request\RequestReportRequest $request);

    /**
     * @param  RequestReportRequest  $request
     * @return PromiseInterface
     */
    function RequestReportAsync(Request\RequestReportRequest $request);


    /**
     * Returns a list of report requests that you can use to get the ReportRequestId for a report.
     *
     * @see http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReportRequestList.html
     *
     * @param  GetReportRequestListRequest  $request
     * @return GetReportRequestListResult
     */
    function GetReportRequestList(Request\GetReportRequestListRequest $request);

    /**
     * @param  GetReportRequestListRequest  $request
     * @return PromiseInterface
     */
    public function GetReportRequestListAsync(Request\GetReportRequestListRequest $request);


    /**
     * Returns a list of report requests using the NextToken, which was supplied by a previous request to either
     * GetReportRequestListByNextToken or GetReportRequestList, where the value of HasNext was true in that previous
     * request.
     *
     * @see http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReportRequestListByNextToken.html
     *
     * @param  GetReportRequestListByNextTokenRequest  $request
     * @return GetReportRequestListResult
     */
    function GetReportRequestListByNextToken(Request\GetReportRequestListByNextTokenRequest $request);

    /**
     * @param  GetReportRequestListByNextTokenRequest  $request
     * @return PromiseInterface
     */
    public function GetReportRequestListByNextTokenAsync(Request\GetReportRequestListByNextTokenRequest $request);


    /**
     * Returns a count of report requests that have been submitted to Amazon MWS for processing.
     *
     * @see http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReportRequestCount.html
     *
     * @param  GetReportRequestCountRequest  $request
     * @return GetReportRequestCountResult
     */
    function GetReportRequestCount(Request\GetReportRequestCountRequest $request);

    /**
     * @param  GetReportRequestCountRequest  $request
     * @return PromiseInterface
     */
    public function GetReportRequestCountAsync(Request\GetReportRequestCountRequest $request);


    /**
     * Cancels one or more report requests.
     *
     * @see http://docs.developer.amazonservices.com/en_US/reports/Reports_CancelReportRequests.html
     *
     * @param  CancelReportRequestsRequest  $request
     * @return CancelReportRequestsResult
     */
    function CancelReportRequests(Request\CancelReportRequestsRequest $request);

    /**
     * @param  CancelReportRequestsRequest  $request
     * @return PromiseInterface
     */
    public function CancelReportRequestsAsync(Request\CancelReportRequestsRequest $request);


    /**
     * Returns a list of reports that were created in the previous 90 days.
     *
     * @see http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReportList.html
     *
     * @param  GetReportListRequest  $request
     * @return GetReportListResult
     */
    function GetReportList(Request\GetReportListRequest $request);

    /**
     * @param  GetReportListRequest  $request
     * @return PromiseInterface
     */
    public function GetReportListAsync(Request\GetReportListRequest $request);


    /**
     * Returns a list of reports using the NextToken, which was supplied by a previous request to either
     * GetReportListByNextToken or GetReportList, where the value of HasNext was true in the previous call.
     *
     * @see http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReportListByNextToken.html
     *
     * @param  GetReportListByNextTokenRequest  $request
     * @return GetReportListByNextTokenResult
     */
    function GetReportListByNextToken(Request\GetReportListByNextTokenRequest $request);

    /**
     * @param  GetReportListByNextTokenRequest  $request
     * @return PromiseInterface
     */
    public function GetReportListByNextTokenAsync(Request\GetReportListByNextTokenRequest $request);


    /**
     * Returns a count of the reports, created in the previous 90 days, with a status of _DONE_ and that are available
     * for download.
     *
     * @see http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReportCount.html
     *
     * @param  GetReportCountRequest  $request
     * @return GetReportCountResult
     */
    function GetReportCount(Request\GetReportCountRequest $request);

    /**
     * @param  GetReportCountRequest  $request
     * @return PromiseInterface
     */
    function GetReportCountAsync(Request\GetReportCountRequest $request);


    /**
     * Returns the contents of a report and the Content-MD5 header for the returned report body.
     *
     * @see http://docs.developer.amazonservices.com/en_US/reports/Reports_GetReport.html
     *
     * @param  GetReportRequest  $request
     * @return GetReportResult
     */
    function GetReport(Request\GetReportRequest $request);

    /**
     * @param  GetReportRequest  $request
     * @return PromiseInterface
     */
    function GetReportAsync(Request\GetReportRequest $request);
}