<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Orders;

use SellerWorks\Amazon\MWS\Common\RecordIterator;
use SellerWorks\Amazon\MWS\Common\Results\GetServiceStatusResult;
use SellerWorks\Amazon\MWS\Common\Passport;

/**
 * Amazon MWS Orders
 *
 * With the Orders API section of Amazon Marketplace Web Service (Amazon MWS), you can build simple applications that
 * retrieve only the order information that you need. This enables you to develop fast, flexible, custom applications in
 * areas like order synchronization, order research, and demand-based decision support tools.
 *
 * @url http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/
 * @version 2013-09-01
 */
interface OrdersInterface
{
    /**
     * Returns orders created or updated during a time frame that you specify.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrders.html
     *
     * @param  ListOrdersRequest $request
     * @param  Passport $passport
     * @return RecordIterator
     */
//     function ListOrders(Requests\ListOrdersRequest $request, Passport $passport = null): RecordIterator;

    /**
     * Returns the next page of orders using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrdersByNextToken.html
     *
     * @param  string  $NextToken
     * @param  Passport  $passport
     * @return ListOrdersByNextTokenResult
     */
//     function ListOrdersByNextToken(string $NextToken, Passport $passport = null): Results\ListOrdersByNextTokenResult;

    /**
     * Returns orders based on the AmazonOrderId values that you specify.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_GetOrder.html
     *
     * @param  GetOrderRequest  $request
     * @param  Passport  $passport
     * @return GetOrderResult
     */
//     function GetOrder(Requests\GetOrderRequest $request, Passport $passport = null): Results\GetOrderResult;

    /**
     * Returns order items based on the AmazonOrderId that you specify.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrderItems.html
     *
     * @param  ListOrderItemsRequest  $request
     * @param  Passport  $passport
     * @return RecordIterator
     */
//     function ListOrderItems(Requests\ListOrderItemsRequest $request, Passport $passport = null): RecordIterator;

    /**
     * Returns the next page of order items using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrderItemsByNextToken.html
     *
     * @param  string  $NextToken
     * @param  Passport  $passport
     * @return ListOrderItemsByNextTokenResult
     */
//     function ListOrderItemsByNextToken(string $NextToken, Passport $passport = null): Results\ListOrderItemsByNextTokenResult;

    /**
     * Returns the operational status of the Orders API section.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/MWS_GetServiceStatus.html
     *
     * @param  GetServiceStatusRequest  $request
     * @param  Passport  $passport
     * @return GetServiceStatusResult
     */
    function GetServiceStatus(): GetServiceStatusResult;
}