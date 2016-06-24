<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use GuzzleHttp\Promise\PromiseInterface;
use SellerWorks\Amazon\MWS\Common\RecordIterator;
use SellerWorks\Amazon\MWS\Common\Results\GetServiceStatusResult;

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
    function CreateInboundShipmentPlan(
        Requests\CreateInboundShipmentPlanRequest $request
    ):  Results\CreateInboundShipmentPlanResult;

    /**
     * @param  CreateInboundShipmentPlanRequest $request
     * @return PromiseInterface
     */
    function CreateInboundShipmentPlanAsync(
        Requests\CreateInboundShipmentPlanRequest $request
    ):  PromiseInterface;


    /**
     * Creates an inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipment.html
     *
     * @param  CreateInboundShipmentRequest
     * @return CreateInboundShipmentResult
     */
    function CreateInboundShipment(
        Requests\CreateInboundShipmentRequest $request
    ):  Results\CreateInboundShipmentResult;

    /**
     * @param  CreateInboundShipmentRequest $request
     * @return PromiseInterface
     */
    function CreateInboundShipmentAsync(
        Requests\CreateInboundShipmentRequest $request
    ):  PromiseInterface;


    /**
     * Updates an existing inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_UpdateInboundShipment.html
     *
     * @param  UpdateInboundShipmentRequest
     * @return UpdateInboundShipmentResult
     */
    public function UpdateInboundShipment(
        Requests\UpdateInboundShipmentRequest $request
    ):  Results\UpdateInboundShipmentResult;


    /**
     * Returns labeling requirements and item preparation instructions to help you prepare items for an inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForSKU.html
     *
     * @param  GetPrepInstructionsForSKURequest
     * @return GetPrepInstructionsForSKUResult
     */
    function GetPrepInstructionsForSKU(
        Requests\GetPrepInstructionsForSKURequest $request
    ):  Results\GetPrepInstructionsForSKUResult;


    /**
     * Returns item preparation instructions to help with item sourcing decisions.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForASIN.html
     *
     * @param  GetPrepInstructionsForASINRequest
     * @return GetPrepInstructionsForASINResult
     */
    function GetPrepInstructionsForASIN(
        Requests\GetPrepInstructionsForASINRequest $request
    ):  Results\GetPrepInstructionsForASINResult;
    

    /**
     * Returns a list of inbound shipments based on criteria that you specify.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipments.html
     *
     * @param  ListInboundShipmentsRequest $request
     * @return RecordIterator
     */
    function ListInboundShipments(
        Requests\ListInboundShipmentsRequest $request
    ):  RecordIterator;


    /**
     * Returns the next page of inbound shipments using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentsByNextToken.html
     *
     * @param  string $token
     * @return ListInboundShipmentsResult
     */
    function ListInboundShipmentsByNextToken(
        string $token
    ):  Results\ListInboundShipmentsByNextTokenResult;


    /**
     * Returns a list of items in a specified inbound shipment, or a list of items that were updated within a specified time frame.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItems.html
     *
     * @param  ListInboundShipmentItemsRequest
     * @return RecordIterator
     */
    function ListInboundShipmentItems(
        Requests\ListInboundShipmentItemsRequest $request
    ):  RecordIterator;


    /**
     * Returns the next page of inbound shipment items using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItemsByNextToken.html
     *
     * @param  string  $token
     * @return ListInboundShipmentItemsByNextTokenResult
     */
    function ListInboundShipmentItemsByNextToken(
        string $token
    ):  Results\ListInboundShipmentItemsByNextTokenResult;


    /**
     * Returns the operational status of the Fulfillment Inbound Shipment API section.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/MWS_GetServiceStatus.html
     *
     * @return GetServiceStatusResponse
     */
    function GetServiceStatus(): GetServiceStatusResult;
}