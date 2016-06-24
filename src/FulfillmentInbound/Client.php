<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\RecordIterator;
use SellerWorks\Amazon\MWS\Common\Requests\GetServiceStatusRequest;
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
     * @param  CreateInboundShipmentPlanRequest  $request
     * @return CreateInboundShipmentPlanResult
     */
    public function CreateInboundShipmentPlan(
        Requests\CreateInboundShipmentPlanRequest $request
    ):  Results\CreateInboundShipmentPlanResult
    {
        return $this->send($request)->wait()->CreateInboundShipmentPlanResult;
    }

    /**
     * @param  CreateInboundShipmentPlanRequest  $request
     * @return PromiseInterface
     */
    public function CreateInboundShipmentPlanAsync(
        Requests\CreateInboundShipmentPlanRequest $request
    ):  PromiseInterface
    {
        return $this->send($request);
    }

    /**
     * @param  CreateInboundShipmentRequest  $request
     * @return CreateInboundShipmentResult
     */
    public function CreateInboundShipment(
        Requests\CreateInboundShipmentRequest $request
    ):  Results\CreateInboundShipmentResult
    {
        $this->CreateInboundShipmentAsync($request)->wait();
    }

    /**
     * @param  CreateInboundShipmentRequest  $request
     * @return PromiseInterface
     */
    public function CreateInboundShipmentAsync(
        Requests\CreateInboundShipmentRequest $request
    ):  PromiseInterface
    {
        $promise = $this->send($request)->then(
            function ($response) {
                return $response->CreateInboundShipmentResult;
            }
        );

        return $promise;
    }

    /**
     * @param  UpdateInboundShipmentRequest  $request
     * @return UpdateInboundShipmentResult
     */
    public function UpdateInboundShipment(
        Requests\UpdateInboundShipmentRequest $request
    ):  Results\UpdateInboundShipmentResult
    {
        return $this->UpdateInboundShipmentAsync($request)->wait();
    }

    /**
     * @param  UpdateInboundShipmentRequest  $request
     * @return PromiseInterface
     */
    public function UpdateInboundShipmentAsync(
        Requests\UpdateInboundShipmentRequest $request
    ):  PromiseInterface
    {
        $promise = $this->send($request)->then(
            function ($response) {
                return $response->UpdateInboundShipmentResult;
            }
        );

        return $promise;
    }

    /**
     * @param  GetPrepInstructionsForSKURequest  $request
     * @return GetPrepInstructionsForSKUResult
     */
    public function GetPrepInstructionsForSKU(
        Requests\GetPrepInstructionsForSKURequest $request
    ):  Results\GetPrepInstructionsForSKUResult
    {
        return $this->GetPrepInstructionsForSKUAsync($request)->wait();
    }

    /**
     * @param  GetPrepInstructionsForASINRequest  $request
     * @return PromiseInterface
     */
    public function GetPrepInstructionsForSKUAsync(
        Requests\GetPrepInstructionsForSKURequest $request
    ):  PromiseInterface
    {
        $promise = $this->send($request)->then(
            function ($response) {
                return $response->GetPrepInstructionsForSKUResult;
            }
        );

        return $promise;
    }

    /**
     * @param  GetPrepInstructionsForASINRequest  $request
     * @return GetPrepInstructionsForASINResult
     */
    public function GetPrepInstructionsForASIN(
        Requests\GetPrepInstructionsForASINRequest $request
    ):  Results\GetPrepInstructionsForASINResult
    {
        return $this->GetPrepInstructionsForASINAsync($request)->wait();
    }

    /**
     * @param  GetPrepInstructionsForASINRequest  $request
     * @return PromiseInterface
     */
    public function GetPrepInstructionsForASINAsync(
        Requests\GetPrepInstructionsForASINRequest $request
    ):  PromiseInterface
    {
        $promise = $this->send($request)->then(
            function ($response) {
                return $response->GetPrepInstructionsForASINResult;
            }
        );

        return $promise;
    }

    /**
     * @param  ListInboundShipmentsRequest  $request
     * @return ListInboundShipmentsResult
     */
    public function ListInboundShipments(
        Requests\ListInboundShipmentsRequest $request
    ):  Results\ListInboundShipmentsResult
    {
        return $this->ListInboundShipmentsAsync($request)->wait();
    }

    /**
     * @param  ListInboundShipmentsRequest  $request
     * @return PromiseInterface
     */
    public function ListInboundShipmentsAsync(
        ListInboundShipmentsRequest $request
    ):  PromiseInterface
    {
        $promise = $this->send($request)->then(
            function ($response) {
                return $response->ListInboundShipmentsResult;
            }
        );

        return $promise;
    }

    /**
     * @param  ListInboundShipmentsByNextTokenRequest  $request
     * @return ListInboundShipmentsByNextTokenResult
     */
    public function ListInboundShipmentsByNextToken(
        string $token
    ):  Results\ListInboundShipmentsByNextTokenResult
    {
        return $this->ListInboundShipmentsByNextTokenAsync($request)->wait();
    }

    /**
     * @param  ListInboundShipmentsByNextTokenRequest  $request
     * @return PromiseInterface
     */
    public function ListInboundShipmentsByNextTokenAsync(
        ListInboundShipmentsByNextTokenRequest $request
    ):  PromiseInterface
    {
        $promise = $this->send($request)->then(
            function ($response) {
                return $response->ListInboundShipmentsByNextTokenResult;
            }
        );

        return $promise;
    }

    /**
     * {@inheritDoc}
     */
/*
    public function ListInboundShipmentItems(
        Requests\ListInboundShipmentItemsRequest $request
    ):  RecordIterator
    {
        $response = $this->makeRequest($request, $passport);
        $passport = $passport?: $this->getPassport();
        $iterator = new RecordIterator($this, $passport, $response->getResult());

        return $iterator;
    }
*/

    /**
     * @param  ListInboundShipmentItemsRequest  $request
     * @return ListInboundShipmentItemsResult
     */
    public function ListInboundShipmentItems(
        Requests\ListInboundShipmentItemsRequest $request
    ):  Results\ListInboundShipmentItemsResult
    {
        return $this->ListInboundShipmentItemsAsync($request)->wait();
    }

    /**
     * @param  ListInboundShipmentItemsRequest  $request
     * @return PromiseInterface
     */
    public function ListInboundShipmentItemsAsync(
        ListInboundShipmentItemsRequest $request
    ):  PromiseInterface
    {
        $promise = $this->send($request)->then(
            function ($response) {
                return $response->ListInboundShipmentItemsResult;
            }
        );

        return $promise;
    }

    /**
     * @param  ListInboundShipmentItemsByNextTokenRequest  $request
     * @return ListInboundShipmentItemsByNextTokenResult
     */
    public function ListInboundShipmentItemsByNextToken(
        string $token
    ):  Results\ListInboundShipmentItemsByNextTokenResult
    {
        return $this->ListInboundShipmentItemsByNextTokenAsync($request)->wait();
    }

    /**
     * @param  ListInboundShipmentItemsByNextTokenRequest  $request
     * @return PromiseInterface
     */
    public function ListInboundShipmentItemsByNextTokenAsync(
        ListInboundShipmentItemsByNextTokenRequest $request
    ):  PromiseInterface
    {
        $promise = $this->send($request)->then(
            function ($response) {
                return $response->ListInboundShipmentItemsByNextTokenResult;
            }
        );

        return $promise;
    }

    /**
     * @return GetServiceStatusResult
     */
    public function GetServiceStatus(): GetServiceStatusResult
    {
        return $this->GetServiceStatusAsync()->wait();
    }

    /**
     * @return PromiseInterface
     */
    public function GetServiceStatusAsync(): PromiseInterface
    {
        $promise = $this->send(new GetServiceStatusRequest)->then(
            function ($response) {
                return $response->GetServiceStatusResult;
            }
        );

        return $promise;
    }
}