<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use SellerWorks\Amazon\MWS\Common\RecordIterator;
use SellerWorks\Amazon\MWS\Common\Passport;

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
     * @param  Passport $passport
     * @return CreateInboundShipmentPlanResponse
     */
    function createInboundShipmentPlan(
        Requests\CreateInboundShipmentPlanRequest $request,
        Passport $passport = null
    ):  Results\CreateInboundShipmentPlanResult;

    /**
     * Creates an inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipment.html
     *
     * @param  Requests\CreateInboundShipmentRequest
     * @param  Passport $passport
     * @return Responses\CreateInboundShipmentResponse
     */
    function createInboundShipment(
        Requests\CreateInboundShipmentRequest $request,
        Passport $passport = null
    ):  Responses\CreateInboundShipmentResponse;

    /**
     * Updates an existing inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_UpdateInboundShipment.html
     *
     * @param  Requests\UpdateInboundShipmentRequest
     * @param  Passport $passport
     * @return Responses\UpdateInboundShipmentResponse
     */
    function updateInboundShipment(
        Requests\UpdateInboundShipmentRequest $request,
        Passport $passport = null
    ):  Responses\UpdateInboundShipmentResponse;

    // GetPreorderInfo
    // ConfirmPreorder

    /**
     * Returns labeling requirements and item preparation instructions to help you prepare items for an inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForSKU.html
     *
     * @param  Requests\GetPrepInstructionsForSKURequest
     * @param  Passport $passport
     * @return Responses\GetPrepInstructionsForSKUResponse
     */
    function getPrepInstructionsForSKU(
        Requests\GetPrepInstructionsForSKURequest $request,
        Passport $passport = null
    ):  Responses\GetPrepInstructionsForSKUResponse;

    /**
     * Returns item preparation instructions to help with item sourcing decisions.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForASIN.html
     *
     * @param  Requests\GetPrepInstructionsForASINRequest
     * @param  Passport $passport
     * @return Responses\GetPrepInstructionsForASINResponse
     */
    function GetPrepInstructionsForASIN(
        Requests\GetPrepInstructionsForASINRequest $request,
        Passport $passport = null
    ):  Responses\GetPrepInstructionsForASINResponse;
    
    // PutTransportContent
    // EstimateTransportRequest
    // GetTransportContent
    // ConfirmTransportRequest
    // VoidTransportRequest
    // GetPackageLabels
    // GetUniquePackageLabels
    // GetPalletLabels
    // GetBillOfLading

    /**
     * Returns a list of inbound shipments based on criteria that you specify.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipments.html
     *
     * @param  ListInboundShipmentsRequest $request
     * @param  Passport $passport
     * @return RecordIterator
     */
    function listInboundShipments(
        Requests\ListInboundShipmentsRequest $request,
        Passport $passport = null
    ):  RecordIterator;

    /**
     * Returns the next page of inbound shipments using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentsByNextToken.html
     *
     * @param  string $token
     * @param  Passport $passport
     * @return ListInboundShipmentsResult
     */
    function listInboundShipmentsByNextToken(
        string $token,
        Passport $passport = null
    ):  Results\ListInboundShipmentsResult;

    /**
     * Returns a list of items in a specified inbound shipment, or a list of items that were updated within a specified time frame.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItems.html
     *
     * @param  Requests\ListInboundShipmentItemsRequest
     * @param  Passport $passport
     * @return RecordIterator
     */
    function listInboundShipmentItems(
        Requests\ListInboundShipmentItemsRequest $request,
        Passport $passport = null
    ):  RecordIterator;

    /**
     * Returns the next page of inbound shipment items using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItemsByNextToken.html
     *
     * @param  Requests\ListInboundShipmentItemsByNextTokenRequest
     * @param  Passport $passport
     * @return Responses\ListInboundShipmentItemsByNextTokenResponse
     */
/*
    function listInboundShipmentItemsByNextToken(
        Requests\ListInboundShipmentItemsByNextTokenRequest $request,
        Passport $passport = null
    ):  Responses\ListInboundShipmentItemsByNextTokenResponse;
*/

    /**
     * Returns the operational status of the Fulfillment Inbound Shipment API section.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/MWS_GetServiceStatus.html
     *
     * @return Responses\GetServiceStatusResponse
     */
    function getServiceStatus(): Results\GetServiceStatusResult;
}