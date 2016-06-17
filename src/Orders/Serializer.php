<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Orders;

use DateTimeInterface;
use ReflectionClass;
use ReflectionProperty;
use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\Requests\GetServiceStatusRequest;
use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\SerializerInterface;
use UnexpectedValueException;

/**
 * FulfillmentInboundShipment serializer.
 *
 * Premature optimization? I think not!
 */
class Serializer implements SerializerInterface
{
    /**
     * @var  Sabre\Xml\Service
     */
    protected $xmlService;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->xmlService = new XmlService;
    }

    /**
     * {@inheritDoc}
     */
    public function serialize(RequestInterface $request): array
    {
        // Validate request is valid type and set action.
        switch (true) {
            case $request instanceof GetServiceStatusRequest:
                return $this->serializeGetServiceStatus($request);

            default:
                throw new UnexpectedValueException(getType($request) . ' is not supported.');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize(string $response): ResponseInterface
    {
        return $this->xmlService->parse($response);
    }

    /**
     * Serialize GetServiceStatus
     *
     * @param  GetServiceStatusRequest  $request
     * @return array
     */
    protected function serializeGetServiceStatus(GetServiceStatusRequest $request): array
    {
        $array = ['Action' => 'GetServiceStatus'];

        return $array;
    }
}