<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use Exception;
use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\ResultInterface;
use SellerWorks\Amazon\MWS\Common\Passport;

/**
 * With the Fulfillment Inbound Shipment API section of Amazon Marketplace Web Service (Amazon MWS), you can create and
 * update inbound shipments of inventory in the Amazon Fulfillment Network. You can also request lists of inbound
 * shipments or inbound shipment items based on criteria that you specify. After your inventory has been received by the
 * Amazon Fulfillment Network, Amazon can fulfill your orders regardless of whether you are selling on Amazon's retail
 * web site or through other retail channels.
 */
class Client extends AbstractClient implements FulfillmentInboundInterface
{
    /**
     * MWS Service definitions.
     */
    const MWS_PATH    = '/FulfillmentInboundShipment/2010-10-01/';
    const MWS_VERSION = '2010-10-01';

    /**
     * {@inheritDoc}
     */
    public function __construct(Passport $passport = null)
    {
        parent::__construct($passport);
        $this->setSerializer(new Serializer);
    }

    /**
     * {@inheritDoc}
     */
    public function createInboundShipmentPlan(
        Requests\CreateInboundShipmentPlanRequest $request,
        Passport $passport = null
    ):  Results\CreateInboundShipmentPlanResult
    {
        $response = $this->makeRequest($request, $passport);

        if ($response instanceof Responses\ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->CreateInboundShipmentPlanResult;
    }

    /**
     * {@inheritDoc}
     */
    public function createInboundShipment(
        Requests\CreateInboundShipmentRequest $request
    ):  Responses\CreateInboundShipmentResponse
    {
        return $this->makeRequest($request);
    }

    /**
     * {@inheritDoc}
     */
    public function updateInboundShipment(
        Requests\UpdateInboundShipmentRequest $request
    ):  Responses\UpdateInboundShipmentResponse
    {
        return $this->makeRequest($request);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrepInstructionsForSKU(
        Requests\GetPrepInstructionsForSKURequest $request
    ):  Responses\GetPrepInstructionsForSKUResponse
    {
        return $this->makeRequest($request);
    }

    /**
     * {@inheritDoc}
     */
    public function GetPrepInstructionsForASIN(
        Requests\GetPrepInstructionsForASINRequest $request
    ):  Responses\GetPrepInstructionsForASINResponse
    {
        return $this->makeRequest($request);
    }

    /**
     * {@inheritDoc}
     */
    public function listInboundShipments(
        Requests\ListInboundShipmentsRequest $request
    ):  Responses\ListInboundShipmentsResponse
    {
        return $this->makeRequest($request);
    }

    /**
     * {@inheritDoc}
     */
    public function listInboundShipmentItems(
        Requests\ListInboundShipmentItemsRequest $request
    ):  Responses\ListInboundShipmentItemsResponse
    {
        return $this->makeRequest($request);
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceStatus(): Results\GetServiceStatusResult
    {
        $response = $this->makeRequest(new Requests\GetServiceStatusRequest);

        if ($response instanceof Responses\ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->GetServiceStatusResult;
    }

    /**
     * Throw Endpoint-specific error.
     *
     * @param  ResponseInterface
     * @throw  
     */
    protected function throwError(ResponseInterface $response)
    {
        throw new \Exception($response->Error->Message);
    }
}