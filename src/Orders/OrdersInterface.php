<?php

namespace SellerWorks\Amazon\Orders;

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
     * @return ListOrdersResult
     */
    function ListOrders(Request\ListOrdersRequest $request);

    /**
     * @param  ListOrdersRequest $request
     * @return PromiseInterface
     */
    function ListOrdersAsync(Request\ListOrdersRequest $request);


    /**
     * Returns the next page of orders using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrdersByNextToken.html
     *
     * @param  ListOrdersByNextTokenRequest  $request
     * @return ListOrdersByNextTokenResult
     */
    function ListOrdersByNextToken(Request\ListOrdersByNextTokenRequest $request);

    /**
     * @param  ListOrdersByNextTokenRequest  $request
     * @return PromiseInterface
     */
    function ListOrdersByNextTokenAsync(Request\ListOrdersByNextTokenRequest $request);


    /**
     * Returns orders based on the AmazonOrderId values that you specify.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_GetOrder.html
     *
     * @param  GetOrderRequest  $request
     * @return GetOrderResult
     */
    function GetOrder(Request\GetOrderRequest $request);

    /**
     * @param  GetOrderRequest  $request
     * @return PromiseInterface
     */
    function GetOrderAsync(Request\GetOrderRequest $request);


    /**
     * Returns order items based on the AmazonOrderId that you specify.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrderItems.html
     *
     * @param  ListOrderItemsRequest  $request
     * @return ListOrderItemsResult
     */
    function ListOrderItems(Request\ListOrderItemsRequest $request);

    /**
     * @param  ListOrderItemsRequest  $request
     * @return PromiseInterface
     */
    function ListOrderItemsAsync(Request\ListOrderItemsRequest $request);


    /**
     * Returns the next page of order items using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/Orders_ListOrderItemsByNextToken.html
     *
     * @param  ListOrderItemsByNextTokenRequest  $request
     * @return ListOrderItemsByNextTokenResult
     */
    function ListOrderItemsByNextToken(Request\ListOrderItemsByNextTokenRequest $request);

    /**
     * @param  ListOrderItemsByNextTokenRequest  $request
     * @return PromiseInterface
     */
    function ListOrderItemsByNextTokenAsync(Request\ListOrderItemsByNextTokenRequest $request);


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