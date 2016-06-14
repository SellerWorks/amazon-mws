<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

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
 */
class Serializer implements SerializerInterface
{
    /**
     * @var  Sabre\Xml\Service
     */
    protected $xmlService;

    /**
     * Constructor.
     *
     * @return void
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
        $action = '';

        // Validate request is valid type and set action.
        switch (true) {
            case $request instanceof Requests\ListInboundShipmentsRequest:
                $action = 'ListInboundShipments';
                break;

            case $request instanceof Requests\ListInboundShipmentsByNextTokenRequest:
                $action = 'ListInboundShipmentsByNextToken';
                break;

            case $request instanceof Requests\ListInboundShipmentItemsRequest:
                $action = 'ListInboundShipmentItems';
                break;

            case $request instanceof GetServiceStatusRequest:
                $action = 'GetServiceStatus';
                break;

            default:
                throw new UnexpectedValueException(getType($request) . ' is not supported.');
        }

        // Add properties.
        $returnArr = array_merge(['Action' => $action], $this->serializeReflection($request));

        return $returnArr;
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize(string $response): ResponseInterface
    {
        return $this->xmlService->parse($response);
    }

    /**
     * Serialize objects by reflection.
     *
     * @param  RequestInterface  $request
     * @return array
     */
    protected function serializeReflection(RequestInterface $request): array
    {
        $returnArr  = [];
        $reflection = new ReflectionClass($request);
        $properties = $reflection->getProperties();  // ReflectionProperty::IS_PROTECTED

        foreach ($properties as $property) {
            $propName  = $property->getName();
            $propValue = $property->getValue($request);

            switch ($propName) {
                // Array<string> properties.
                case 'ShipmentIdList':
                case 'ShipmentStatusList':
                    if (is_array($propValue) && !empty($propValue)) {
                        $pos = 1;

                        foreach ($propValue as $value) {
                            $key = sprintf('%s.member.%s', $propName, $pos);
                            $returnArr[$key] = $value;
                            ++$pos;
                        }
                    }
                    break;


                // DateTime properties.
                case 'LastUpdatedAfter':
                case 'LastUpdatedBefore':
                    if ($propValue instanceof DateTimeInterface) {
                        $returnArr[$propName] = $propValue->format(static::DATE_FORMAT);
                    }
                    break;

                // String properties.
                case 'NextToken':
                case 'ShipmentId':
                    $returnArr[$propName] = (string) $propValue;
                    break;
            }
        }

        return $returnArr;
    }
}