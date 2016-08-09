<?php

namespace SellerWorks\Amazon\FulfillmentInbound;

use GuzzleHttp\Promise\PromiseInterface;
use SellerWorks\Amazon\Common\RecordIterator;
use SellerWorks\Amazon\Common\Results\GetServiceStatusResult;

/**
 * Amazon MWS Fulfillment Inbound Shipment
 *
 * With the Fulfillment Inbound Shipment API section of Amazon Marketplace Web Service (Amazon MWS), you can create and
 * update inbound shipments of inventory in the Amazon Fulfillment Network. You can also request lists of inbound
 * shipments or inbound shipment items based on criteria that you specify. After your inventory has been received by the
 * Amazon Fulfillment Network, Amazon can fulfill your orders regardless of whether you are selling on Amazon's retail
 * web site or through other retail channels.
 *
 * @url http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_Overview.html
 * @version 2010-10-01
 */
interface FulfillmentInboundInterface
{
    /**
     * Returns the information required to create an inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipmentPlan.html
     *
     * @param  CreateInboundShipmentPlanRequest $request
     * @return CreateInboundShipmentPlanResponse
     */
//     function CreateInboundShipmentPlan(Request\CreateInboundShipmentPlanRequest $request);

    /**
     * @param  CreateInboundShipmentPlanRequest $request
     * @return PromiseInterface
     */
//     function CreateInboundShipmentPlanAsync(Request\CreateInboundShipmentPlanRequest $request);


    /**
     * Creates an inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipment.html
     *
     * @param  CreateInboundShipmentRequest
     * @return CreateInboundShipmentResult
     */
//     function CreateInboundShipment(Request\CreateInboundShipmentRequest $request);

    /**
     * @param  CreateInboundShipmentRequest $request
     * @return PromiseInterface
     */
//     function CreateInboundShipmentAsync(Request\CreateInboundShipmentRequest $request);


    /**
     * Updates an existing inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_UpdateInboundShipment.html
     *
     * @param  UpdateInboundShipmentRequest
     * @return UpdateInboundShipmentResult
     */
//     public function UpdateInboundShipment(Request\UpdateInboundShipmentRequest $request);


    /**
     * Returns labeling requirements and item preparation instructions to help you prepare items for an inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForSKU.html
     *
     * @param  GetPrepInstructionsForSKURequest
     * @return GetPrepInstructionsForSKUResult
     */
//     function GetPrepInstructionsForSKU(Request\GetPrepInstructionsForSKURequest $request);


    /**
     * Returns item preparation instructions to help with item sourcing decisions.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForASIN.html
     *
     * @param  GetPrepInstructionsForASINRequest
     * @return GetPrepInstructionsForASINResult
     */
//     function GetPrepInstructionsForASIN(Request\GetPrepInstructionsForASINRequest $request);


    /**
     * Returns a list of inbound shipments based on criteria that you specify.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipments.html
     *
     * @param  ListInboundShipmentsRequest $request
     * @return ListInboundShipmentsResult
     */
    function ListInboundShipments(Request\ListInboundShipmentsRequest $request);

    /**
     * @param  ListInboundShipmentsRequest $request
     * @return PromiseInterface
     */
    function ListInboundShipmentsAsync(Request\ListInboundShipmentsRequest $request);


    /**
     * Returns the next page of inbound shipments using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentsByNextToken.html
     *
     * @param  ListInboundShipmentsByNextTokenRequest $request
     * @return ListInboundShipmentsResult
     */
    function ListInboundShipmentsByNextToken(Request\ListInboundShipmentsByNextTokenRequest $request);

    /**
     * @param  ListInboundShipmentsByNextTokenRequest $request
     * @return PromiseInterface
     */
    function ListInboundShipmentsByNextTokenAsync(Request\ListInboundShipmentsByNextTokenRequest $request);


    /**
     * Returns a list of items in a specified inbound shipment, or a list of items that were updated within a specified time frame.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItems.html
     *
     * @param  ListInboundShipmentItemsRequest
     * @return ListInboundShipmentItemsResult
     */
    function ListInboundShipmentItems(Request\ListInboundShipmentItemsRequest $request);

    /**
     * @param  ListInboundShipmentItemsRequest
     * @return PromiseInterface
     */
    function ListInboundShipmentItemsAsync(Request\ListInboundShipmentItemsRequest $request);


    /**
     * Returns the next page of inbound shipment items using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItemsByNextToken.html
     *
     * @param  ListInboundShipmentItemsByNextTokenRequest  $request
     * @return ListInboundShipmentItemsByNextTokenResult
     */
    function ListInboundShipmentItemsByNextToken(Request\ListInboundShipmentItemsByNextTokenRequest $request);

    /**
     * @param  ListInboundShipmentItemsByNextTokenRequest  $request
     * @return PromiseInterface
     */
    function ListInboundShipmentItemsByNextTokenAsync(Request\ListInboundShipmentItemsByNextTokenRequest $request);


    /**
     * Returns the operational status of the Fulfillment Inbound Shipment API section.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/MWS_GetServiceStatus.html
     *
     * @return GetServiceStatusResponse
     */
    function GetServiceStatus();

    /**
     * @return PromiseInterface
     */
    function GetServiceStatusAsync();
}