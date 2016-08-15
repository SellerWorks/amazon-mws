<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Serializer;

use DateTimeInterface;
use ReflectionClass;
use ReflectionProperty;
use UnexpectedValueException;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Common\SerializerInterface;
use SellerWorks\Amazon\Common\Serializer\Serializer as BaseSerializer;
use SellerWorks\Amazon\FulfillmentInbound\Entity;
use SellerWorks\Amazon\FulfillmentInbound\Request;

/**
 * Request Serializer / Response Deserializer.
 */
class Serializer extends BaseSerializer implements SerializerInterface
{
    /**
     * @var Sabre\Xml\Service
     */
    private $xmlDeserializer;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->xmlDeserializer = new XmlDeserializer;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize(RequestInterface $request)
    {
        // Validate request is valid type and set action.
        switch (true) {
            case $request instanceof Request\CreateInboundShipmentPlanRequest;
                $action = 'CreateInboundShipmentPlan';
                break;

            case $request instanceof Request\CreateInboundShipmentRequest;
                $action = 'CreateInboundShipment';
                break;

            case $request instanceof Request\UpdateInboundShipmentRequest:
                $action = 'UpdateInboundShipment';
                break;

            case $request instanceof Request\GetPrepInstructionsForSKURequest:
                $action = 'GetPrepInstructionsForSKU';
                break;

            case $request instanceof Request\GetPrepInstructionsForASINRequest:
                $action = 'GetPrepInstructionsForASIN';
                break;

            case $request instanceof Request\ListInboundShipmentsRequest:
                $action = 'ListInboundShipments';
                break;

            case $request instanceof Request\ListInboundShipmentsByNextTokenRequest:
                $action = 'ListInboundShipmentsByNextToken';
                break;

            case $request instanceof Request\ListInboundShipmentItemsRequest:
                $action = 'ListInboundShipmentItems';
                break;

            case $request instanceof Request\ListInboundShipmentItemsByNextTokenRequest:
                $action = 'ListInboundShipmentItemsByNextToken';
                break;

            case $request instanceof Request\GetServiceStatusRequest:
                $action = 'GetServiceStatus';
                break;

            default:
                throw new UnexpectedValueException(getclass($request) . ' is not supported.');
        }

        return $this->serializeProperties($action, $request);
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($response)
    {
        return $this->xmlDeserializer->parse($response);
    }
}
