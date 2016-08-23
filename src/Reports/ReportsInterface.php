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
}