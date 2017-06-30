<?php

namespace SellerWorks\Amazon\Orders\Serializer;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Common\Serializer\Serializer as BaseSerializer;
use SellerWorks\Amazon\Orders\Request;
use UnexpectedValueException;

/**
 * Order Serializer.
 */
final class Serializer extends BaseSerializer
{
    /** @var Sabre\Xml\Service */
    private $xmlDeserializer;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->xmlDeserializer = new XmlDeserializer();
    }

    /**
     * {@inheritDoc}
     */
    public function serialize(RequestInterface $request)
    {
        // Validate request is valid type and set action.
        switch (true) {
            case $request instanceof Request\ListOrdersRequest:
                $action = 'ListOrders';
                break;

            case $request instanceof Request\ListOrdersByNextTokenRequest:
                $action = 'ListOrdersByNextToken';
                break;

            case $request instanceof Request\GetOrderRequest:
                $action = 'GetOrder';
                break;

            case $request instanceof Request\ListOrderItemsRequest:
                $action = 'ListOrderItems';
                break;

            case $request instanceof Request\ListOrderItemsByNextTokenRequest:
                $action = 'ListOrderItemsByNextToken';
                break;

            case $request instanceof Request\GetServiceStatusRequest:
                $action = 'GetServiceStatus';
                break;

            default:
                throw new UnexpectedValueException(get_class($request) . ' is not supported.');
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
