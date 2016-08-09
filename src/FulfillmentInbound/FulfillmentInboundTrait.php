<?php

namespace SellerWorks\Amazon\FulfillmentInbound;

/**
 * Implements the plumbing methods of FulfillmentInboundInterface.
 */
trait FulfillmentInboundTrait
{
    /**
     * @param  CreateInboundShipmentPlanRequest $request
     * @return CreateInboundShipmentPlanResponse
     */
    function CreateInboundShipmentPlan(Request\CreateInboundShipmentPlanRequest $request)
    {
        return $this->CreateInboundShipmentPlanAsync($request)->wait();
    }

    /**
     * @param  CreateInboundShipmentPlanRequest $request
     * @return PromiseInterface
     */
    function CreateInboundShipmentPlanAsync(Request\CreateInboundShipmentPlanRequest $request)
    {
        return $this->send($request, 2);
    }

    /**
     * @param  ListInboundShipmentsRequest $request
     * @return ListInboundShipmentsResult
     */
    function ListInboundShipments(Request\ListInboundShipmentsRequest $request)
    {
        return $this->ListInboundShipmentsAsync($request)->wait();
    }

    /**
     * @param  ListInboundShipmentsRequest $request
     * @return PromiseInterface
     */
    function ListInboundShipmentsAsync(Request\ListInboundShipmentsRequest $request)
    {
        return $this->send($request, 2);
    }



    /**
     * @param  ListInboundShipmentsByNextTokenRequest $request
     * @return ListInboundShipmentsResult
     */
    function ListInboundShipmentsByNextToken(Request\ListInboundShipmentsByNextTokenRequest $request)
    {
        return $this->ListInboundShipmentsByNextTokenAsync($request)->wait();
    }

    /**
     * @param  ListInboundShipmentsByNextTokenRequest $request
     * @return PromiseInterface
     */
    function ListInboundShipmentsByNextTokenAsync(Request\ListInboundShipmentsByNextTokenRequest $request)
    {
        return $this->send($request, 2);
    }



    /**
     * @param  ListInboundShipmentItemsRequest
     * @return ListInboundShipmentItemsResult
     */
    function ListInboundShipmentItems(Request\ListInboundShipmentItemsRequest $request)
    {
        return $this->ListInboundShipmentItemsAsync($request)->wait();
    }

    /**
     * @param  ListInboundShipmentItemsRequest
     * @return PromiseInterface
     */
    function ListInboundShipmentItemsAsync(Request\ListInboundShipmentItemsRequest $request)
    {
        return $this->send($request, 2);
    }



    /**
     * @param  ListInboundShipmentItemsByNextTokenRequest  $request
     * @return ListInboundShipmentItemsByNextTokenResult
     */
    function ListInboundShipmentItemsByNextToken(Request\ListInboundShipmentItemsByNextTokenRequest $request)
    {
        return $this->ListInboundShipmentItemsByNextTokenAsync($request)->wait();
    }

    /**
     * @param  ListInboundShipmentItemsByNextTokenRequest  $request
     * @return PromiseInterface
     */
    function ListInboundShipmentItemsByNextTokenAsync(Request\ListInboundShipmentItemsByNextTokenRequest $request)
    {
        return $this->send($request, 2);
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
