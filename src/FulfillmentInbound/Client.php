<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\RecordIterator;
use SellerWorks\Amazon\MWS\Common\Requests\GetServiceStatusRequest;
use SellerWorks\Amazon\MWS\Common\Responses\ErrorResponse;
use SellerWorks\Amazon\MWS\Common\Results\GetServiceStatusResult;
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
    public function CreateInboundShipmentPlan(
        Requests\CreateInboundShipmentPlanRequest $request,
        Passport $passport = null
    ):  Results\CreateInboundShipmentPlanResult
    {
        $response = $this->makeRequest($request, $passport);

        if ($response instanceof ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->CreateInboundShipmentPlanResult;
    }

    /**
     * {@inheritDoc}
     */
    function CreateInboundShipment(
        Requests\CreateInboundShipmentRequest $request,
        Passport $passport = null
    ):  Results\CreateInboundShipmentResult
    {
        $response = $this->makeRequest($request, $passport);

        if ($response instanceof ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->CreateInboundShipmentResult;
    }

    /**
     * {@inheritDoc}
     */
    public function UpdateInboundShipment(
        Requests\UpdateInboundShipmentRequest $request,
        Passport $passport = null
    ):  Results\UpdateInboundShipmentResult
    {
        $response = $this->makeRequest($request, $passport);

        if ($response instanceof ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->UpdateInboundShipmentResult;
    }

    /**
     * {@inheritDoc}
     */
    function GetPrepInstructionsForSKU(
        Requests\GetPrepInstructionsForSKURequest $request,
        Passport $passport = null
    ):  Results\GetPrepInstructionsForSKUResult
    {
        $response = $this->makeRequest($request, $passport);

        if ($response instanceof ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->GetPrepInstructionsForSKUResult;
    }

    /**
     * {@inheritDoc}
     */
    function GetPrepInstructionsForASIN(
        Requests\GetPrepInstructionsForASINRequest $request,
        Passport $passport = null
    ):  Results\GetPrepInstructionsForASINResult
    {
        $response = $this->makeRequest($request, $passport);

        if ($response instanceof ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->GetPrepInstructionsForASINResult;
    }

    /**
     * {@inheritDoc}
     */
    function ListInboundShipments(
        Requests\ListInboundShipmentsRequest $request,
        Passport $passport = null
    ):  RecordIterator
    {
        $response = $this->makeRequest($request, $passport);

        if ($response instanceof ErrorResponse) {
            return $this->throwError($response);
        }

        $passport = $passport?: $this->getPassport();
        $iterator = new RecordIterator($this, $passport, $response->getResult());

        return $iterator;
    }

    /**
     * {@inheritDoc}
     */
    public function ListInboundShipmentsByNextToken(
        string $token,
        Passport $passport = null
    ):  Results\ListInboundShipmentsByNextTokenResult
    {
        $request = new Requests\ListInboundShipmentsByNextTokenRequest;
        $request->NextToken = $token;

        $response = $this->makeRequest($request, $passport);

        if ($response instanceof ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->getResult();
    }

    /**
     * {@inheritDoc}
     */
    function ListInboundShipmentItems(
        Requests\ListInboundShipmentItemsRequest $request,
        Passport $passport = null
    ):  RecordIterator
    {
    }

    /**
     * {@inheritDoc}
     */
    function ListInboundShipmentItemsByNextToken(
        string $token,
        Passport $passport = null
    ):  Results\ListInboundShipmentItemsByNextTokenResult
    {
    }

    /**
     * {@inheritDoc}
     */
    public function GetServiceStatus(): GetServiceStatusResult
    {
        $response = $this->makeRequest(new GetServiceStatusRequest);

        if ($response instanceof ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->GetServiceStatusResult;
    }
}