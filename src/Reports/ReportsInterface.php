<?php

namespace SellerWorks\Amazon\Reports;

/**
 * Amazon MWS Reports
 *
 * With the Orders API section of Amazon Marketplace Web Service (Amazon MWS), you can build simple applications that
 * retrieve only the order information that you need. This enables you to develop fast, flexible, custom applications in
 * areas like order synchronization, order research, and demand-based decision support tools.
 *
 * @url http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/
 * @version 2013-09-01
 */
interface ReportsInterface
{
    /**
     * Returns the operational status of the Orders API section.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/MWS_GetServiceStatus.html
     *
     * @return GetServiceStatusResponse
     */
    function GetServiceStatus();

    /**
     * @return PromiseInterface
     */
    function GetServiceStatusAsync();
}