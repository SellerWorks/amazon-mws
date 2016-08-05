<?php

namespace SellerWorks\Amazon\Orders;

use SellerWorks\Amazon\Common\RecordIterator;

/**
 * Implements the methods of OrdersInterface.
 */
trait OrdersTrait
{
    /**
     * @param  ListOrdersRequest  $request
     * @return ListOrdersResult
     */
    public function ListOrders(Request\ListOrdersRequest $request)
    {
        return $this->ListOrdersAsync($request)->wait();
    }

    /**
     * @param  ListOrdersRequest  $request
     * @return PromiseInterface
     */
    public function ListOrdersAsync(Request\ListOrdersRequest $request)
    {
        return $this->send($request, 10)->then(
            // onFulfilled
            function ($result) {
                return new RecordIterator($this, $result);
            }
        );
    }

    /**
     * @param  ListOrdersByNextTokenRequest  $request
     * @return ListOrdersResult
     */
    public function ListOrdersByNextToken(Request\ListOrdersByNextTokenRequest $request)
    {
        return $this->ListOrdersByNextTokenAsync($request)->wait();
    }

    /**
     * @param  ListOrdersByNextTokenRequest  $request
     * @return PromiseInterface
     */
    public function ListOrdersByNextTokenAsync(Request\ListOrdersByNextTokenRequest $request)
    {
        return $this->send($request, 10);
    }

    /**
     * @param  GetOrderRequest  $request
     * @return GetOrderResult
     */
    public function GetOrder(Request\GetOrderRequest $request)
    {
        return $this->GetOrderAsync($request)->wait();
    }

    /**
     * @param  GetOrderRequest  $request
     * @return PromiseInterface
     */
    public function GetOrderAsync(Request\GetOrderRequest $request)
    {
        return $this->send($request, 3);
    }

    /**
     * @param  ListOrderItemsRequest  $request
     * @return ListOrderItemsResult
     */
    public function ListOrderItems(Request\ListOrderItemsRequest $request)
    {
        return $this->ListOrderItemsAsync($request)->wait();
    }

    /**
     * @param  ListOrderItemsRequest  $request
     * @return PromiseInterface
     */
    public function ListOrderItemsAsync(Request\ListOrderItemsRequest $request)
    {
        return $this->send($request, 10);
    }

    /**
     * @param  ListOrderItemsByNextTokenRequest  $request
     * @return ListOrderItemsResult
     */
    public function ListOrderItemsByNextToken(Request\ListOrderItemsByNextTokenRequest $request)
    {
        return $this->ListOrderItemsByNextTokenAsync($request)->wait();
    }

    /**
     * @param  ListOrderItemsByNextTokenRequest  $request
     * @return PromiseInterface
     */
    public function ListOrderItemsByNextTokenAsync(Request\ListOrderItemsByNextTokenRequest $request)
    {
        return $this->send($request, 10);
    }

    /**
     * @return GetServiceStatusResult
     */
    public function GetServiceStatus()
    {
        return $this->GetServiceStatusAsync()->wait();
    }

    /**
     * @return PromiseInterface
     */
    public function GetServiceStatusAsync()
    {
        return $this->send(new Request\GetServiceStatusRequest);
    }
}
