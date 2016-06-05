<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\Passport;

/**
 * Mock client for unit testing.
 */
class Mock extends AbstractClient // implements FulfillmentInboundInterface
{
    const MWS_VERSION   = '2010-10-01';
    const MWS_PATH      = '/FulfillmentInboundShipment/2010-10-01/';

    /**
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->setSerializer(new Serializer);
    }

    /**
     * {@inheritDoc}
     */
    public function createInboundShipmentPlan(
        Requests\CreateInboundShipmentPlanRequest $request
    ):  Responses\CreateInboundShipmentPlanResponse
    {
        $xml = file_get_contents(__DIR__.'/Mock/CreateInboundShipmentPlanResponse.xml');

        return $this->serializer->unserialize($xml);
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
        Requests\ListInboundShipmentsRequest $request
    ):  Responses\ListInboundShipmentsResponse
    {
        $xml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentsResponse.xml');

        return $this->serializer->unserialize($xml);
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