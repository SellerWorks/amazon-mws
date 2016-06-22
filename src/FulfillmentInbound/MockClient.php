<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use Exception;
use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\RecordIterator;
use SellerWorks\Amazon\MWS\Common\Responses\ErrorResponse;
use SellerWorks\Amazon\MWS\Common\Results\GetServiceStatusResult;
use SellerWorks\Amazon\MWS\Common\Results\Error;
use SellerWorks\Amazon\MWS\Common\Passport;

/**
 * Mock client for unit testing.
 */
class MockClient extends AbstractClient implements FulfillmentInboundInterface
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
        Requests\CreateInboundShipmentPlanRequest $request
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
    function CreateInboundShipment(
        Requests\CreateInboundShipmentRequest $request
    ):  Results\CreateInboundShipmentResult
    {
        $xml = file_get_contents(__DIR__.'/Mock/CreateInboundShipmentResponse.xml');
        $response = $this->serializer->unserialize($xml);

        if ($response instanceof Responses\ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->CreateInboundShipmentResult;
    }

    /**
     * {@inheritDoc}
     */
    public function UpdateInboundShipment(
        Requests\UpdateInboundShipmentRequest $request
    ):  Results\UpdateInboundShipmentResult
    {
        $xml = file_get_contents(__DIR__.'/Mock/UpdateInboundShipmentResponse.xml');
        $response = $this->serializer->unserialize($xml);

        if ($response instanceof Responses\ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->UpdateInboundShipmentResult;
    }

    /**
     * {@inheritDoc}
     */
    function GetPrepInstructionsForSKU(
        Requests\GetPrepInstructionsForSKURequest $request
    ):  Results\GetPrepInstructionsForSKUResult
    {
        $xml = file_get_contents(__DIR__.'/Mock/GetPrepInstructionsForSKUResponse.xml');
        $response = $this->serializer->unserialize($xml);

        if ($response instanceof Responses\ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->GetPrepInstructionsForSKUResult;
    }

    /**
     * {@inheritDoc}
     */
    function GetPrepInstructionsForASIN(
        Requests\GetPrepInstructionsForASINRequest $request
    ):  Results\GetPrepInstructionsForASINResult
    {
        $xml = file_get_contents(__DIR__.'/Mock/GetPrepInstructionsForASINResponse.xml');
        $response = $this->serializer->unserialize($xml);

        if ($response instanceof Responses\ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->GetPrepInstructionsForASINResult;
    }

    /**
     * {@inheritDoc}
     */
    function ListInboundShipments(
        Requests\ListInboundShipmentsRequest $request
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
    function ListInboundShipmentsByNextToken(
        string $token
    ):  Results\ListInboundShipmentsByNextTokenResult
    {
        $xml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentsByNextTokenResponse.xml');
        $response = $this->serializer->unserialize($xml);

        if ($response instanceof Responses\ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->ListInboundShipmentsByNextTokenResult;
    }

    /**
     * {@inheritDoc}
     */
    function ListInboundShipmentItems(
        Requests\ListInboundShipmentItemsRequest $request
    ):  RecordIterator
    {
        $xml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentItemsResponse.xml');
        $response = $this->serializer->unserialize($xml);

        $passport = new Passport('','','','');
        $iterator = new RecordIterator($this, $passport, $response->getResult());

        return $iterator;
    }

    /**
     * {@inheritDoc}
     */
    function ListInboundShipmentItemsByNextToken(
        string $token
    ):  Results\ListInboundShipmentItemsByNextTokenResult
    {
        $xml = file_get_contents(__DIR__.'/Mock/ListInboundShipmentItemsByNextTokenResponse.xml');
        $response = $this->serializer->unserialize($xml);

        if ($response instanceof Responses\ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->ListInboundShipmentItemsByNextTokenResult;
    }

    /**
     * {@inheritDoc}
     */
    public function GetServiceStatus(): GetServiceStatusResult
    {
        $xml = file_get_contents(__DIR__.'/Mock/GetServiceStatusResponse.xml');
        $response = $this->serializer->unserialize($xml);

        if ($response instanceof ErrorResponse) {
            return $this->throwError($response);
        }

        return $response->GetServiceStatusResult;
    }
}