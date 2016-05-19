<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

/**
 * Amazon MWS Fulfillment Inbound Shipment
 *
 * @version 2010-10-01
 */
interface FulfillmentInboundInterface
{
    /**
     * Returns the information required to create an inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipmentPlan.html
     *
     * @param  Requests\CreateInboundShipmentPlanRequest
     * @return Responses\CreateInboundShipmentPlanResponse
     */
    public function createInboundShipmentPlan(
    	Requests\CreateInboundShipmentPlanRequest $request
    ):  Responses\CreateInboundShipmentPlanResponse;

    /**
     * Creates an inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipment.html
     *
     * @param  Requests\CreateInboundShipmentRequest
     * @return Responses\CreateInboundShipmentResponse
     */
//    public function createInboundShipment(
//		Requests\CreateInboundShipmentRequest $request
//	):  Responses\CreateInboundShipmentResponse;

    /**
     * Updates an existing inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_UpdateInboundShipment.html
     *
     * @param  Requests\UpdateInboundShipmentRequest
     * @return Responses\UpdateInboundShipmentResponse
     */
//    public function updateInboundShipment(Requests\UpdateInboundShipmentRequest $request): Responses\UpdateInboundShipmentResponse;

    // GetPreorderInfo
    // ConfirmPreorder

    /**
     * Returns labeling requirements and item preparation instructions to help you prepare items for an inbound shipment.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForSKU.html
     *
     * @param  Requests\GetPrepInstructionsForSKURequest
     * @return Responses\GetPrepInstructionsForSKUResponse
     */
//    public function getPrepInstructionsForSKU(Requests\GetPrepInstructionsForSKURequest $request): Responses\GetPrepInstructionsForSKUResponse;

    /**
     * Returns item preparation instructions to help with item sourcing decisions.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForASIN.html
     *
     * @param  Requests\GetPrepInstructionsForASINRequest
     * @return Responses\GetPrepInstructionsForASINResponse
     */
//    public function GetPrepInstructionsForASIN(Requests\GetPrepInstructionsForASINRequest $request): Responses\GetPrepInstructionsForASINResponse;
    
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
     * @param  Requests\ListInboundShipmentsRequest
     * @return Responses\ListInboundShipmentsResponse
     */
//    public function listInboundShipments(Requests\ListInboundShipmentsRequest $request): Responses\ListInboundShipmentsResponse;

    /**
     * Returns the next page of inbound shipments using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentsByNextToken.html
     *
     * @param  Requests\ListInboundShipmentsByNextTokenRequest
     * @return Responses\ListInboundShipmentsByNextTokenResponse
     */
//    public function listInboundShipmentsByNextToken(Requests\ListInboundShipmentsByNextTokenRequest $request): Responses\ListInboundShipmentsByNextTokenResponse;

    /**
     * Returns a list of items in a specified inbound shipment, or a list of items that were updated within a specified time frame.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItems.html
     *
     * @param  Requests\ListInboundShipmentItemsRequest
     * @return Responses\ListInboundShipmentItemsResponse
     */
//    public function listInboundShipmentItems(Requests\ListInboundShipmentItemsRequest $request): Responses\ListInboundShipmentItemsResponse;

    /**
     * Returns the next page of inbound shipment items using the NextToken parameter.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItemsByNextToken.html
     *
     * @param  Requests\ListInboundShipmentItemsByNextTokenRequest
     * @return Responses\ListInboundShipmentItemsByNextTokenResponse
     */
//    public function listInboundShipmentItemsByNextToken(Requests\ListInboundShipmentItemsByNextTokenRequest $request): Responses\ListInboundShipmentItemsByNextTokenResponse;

    /**
     * Returns the operational status of the Fulfillment Inbound Shipment API section.
     *
     * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/MWS_GetServiceStatus.html
     *
     * @param  Requests\GetServiceStatusRequest
     * @return Responses\GetServiceStatusResponse
     */
    public function getServiceStatus(Requests\GetServiceStatusRequest $request): Responses\GetServiceStatusResponse;
}