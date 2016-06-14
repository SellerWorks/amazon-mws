<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use Exception;
use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\RecordIterator;
use SellerWorks\Amazon\MWS\Common\Results\Error;
use SellerWorks\Amazon\MWS\Common\Passport;

/**
 * Mock client for unit testing.
 */
class MockClient extends AbstractClient // implements FulfillmentInboundInterface
{
    /**
     * MWS Service definitions.
     */
    const MWS_PATH    = '/FulfillmentInboundShipment/2010-10-01/';
    const MWS_VERSION = '2010-10-01';

    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->setSerializer(new Serializer);
    }

    /**
     * Mock error response.
     */
    public function Error(): Results\Error
    {
        $xml = file_get_contents(__DIR__.'/Mock/ErrorResponse.xml');
        $response = $this->serializer->unserialize($xml);

        return $this->throwError($response);
    }

    /**
     * {@inheritDoc}
     */
    public function CreateInboundShipmentPlan(
        Requests\CreateInboundShipmentPlanRequest $request,
        Passport $passport = null
    ):  Results\CreateInboundShipmentPlanResult
    {
        $xml = file_get_contents(__DIR__.'/Mock/CreateInboundShipmentPlanResponse.xml');
        $response = $this->serializer->unserialize($xml);

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
        $xml = file_get_contents(__DIR__.'/Mock/CreateInboundShipmentResponse.xml');

        return $this->serializer->unserialize($xml);
    }

    /**
     * {@inheritDoc}
     */
    public function updateInboundShipment(
        Requests\UpdateInboundShipmentRequest $request
    ):  Responses\UpdateInboundShipmentResponse
    {
        $xml = file_get_contents(__DIR__.'/Mock/UpdateInboundShipmentResponse.xml');

        return $this->serializer->unserialize($xml);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrepInstructionsForSKU(
        Requests\GetPrepInstructionsForSKURequest $request
    ):  Responses\GetPrepInstructionsForSKUResponse
    {
        $xml = file_get_contents(__DIR__.'/Mock/GetPrepInstructionsForSKUResponse.xml');

        return $this->serializer->unserialize($xml);
    }

    /**
     * {@inheritDoc}
     */
    public function GetPrepInstructionsForASIN(
        Requests\GetPrepInstructionsForASINRequest $request
    ):  Responses\GetPrepInstructionsForASINResponse
    {
        $xml = file_get_contents(__DIR__.'/Mock/GetPrepInstructionsForASINResponse.xml');

        return $this->serializer->unserialize($xml);
    }

    /**
     * {@inheritDoc}
     */
    public function listInboundShipments(
        Requests\ListInboundShipmentsRequest $request,
        Passport $passport = null
    ):  RecordIterator
    {
        $xml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentsResponse.xml');
        $response = $this->serializer->unserialize($xml);

        $passport = new Passport('','','','');
        $iterator = new RecordIterator($this, $passport, $response->getResult());

        return $iterator;
    }

    /**
     * {@inheritDoc}
     */
    public function listInboundShipmentItems(
        Requests\ListInboundShipmentItemsRequest $request
    ):  Responses\ListInboundShipmentItemsResponse
    {
        $xml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentItemsResponse.xml');

        return $this->serializer->unserialize($xml);
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceStatus(): Responses\GetServiceStatusResponse
    {
        $xml = file_get_contents(__DIR__.'/Mock/GetServiceStatusResponse.xml');

        return $this->serializer->unserialize($xml);
    }
}