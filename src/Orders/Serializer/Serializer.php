<?php

namespace SellerWorks\Amazon\Orders\Serializer;

use UnexpectedValueException;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\Common\SerializerInterface;
use SellerWorks\Amazon\Orders\Request;

/**
 * Request Serializer / Response Deserializer.
 */
class Serializer implements SerializerInterface
{
    /**
     * @var Sabre\Xml\Service
     */
    protected $xmlDeserializer;

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
            case $request instanceof Request\ListOrdersRequest:
                return $this->serializeListOrders($request);
            case $request instanceof Request\GetServiceStatusRequest:
                return $this->serializeGetServiceStatus($request);

            default:
                throw new UnexpectedValueException(getclass($request) . ' is not supported.');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize($response)
    {
        return $this->xmlDeserializer->parse($response)->getResult();
    }

    /**
     * @param  ListOrdersRequest  $request
     * @return array
     */
    protected function serializeListOrders(Request\ListOrdersRequest $request)
    {
        $array = ['Action' => 'ListOrders'];
        $reflection = new \ReflectionClass(get_class($request));
        
        return $array;
    }

    /**
     * Serialize GetServiceStatus
     *
     * @param  GetServiceStatusRequest  $request
     * @return array
     */
    protected function serializeGetServiceStatus(Request\GetServiceStatusRequest $request)
    {
        $array = ['Action' => 'GetServiceStatus'];

        return $array;
    }
}
