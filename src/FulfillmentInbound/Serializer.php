<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use DateTimeInterface;
use ReflectionClass;
use ReflectionProperty;
use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\SerializerInterface;

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

            case $request instanceof Requests\GetServiceStatusRequest:
                $action = 'GetServiceStatus';
                break;

            default:
                throw new UnexpectedValueException(__CLASS__ . ' is not supported.');
        }

        // Add properties.
        $returnArr = array_merge(['Action' => $action], $this->serializeReflection($request));

        return $returnArr;
    }

    /**
     * {@inheritDoc}
     */
    public function unserialize(string $response) //: ResponseInterface
    {
        // Normalize response.
        $response = str_replace('RequestID>', 'RequestId>', $response);

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
/*
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
*/


                // DateTime properties.
                case 'LastUpdatedAfter':
                case 'LastUpdatedBefore':
                    if ($propValue instanceof DateTimeInterface) {
                        $returnArr[$propName] = $propValue->format(static::DATE_FORMAT);
                    }
                    break;
            }
        }

        return $returnArr;
    }

    /**
     * Serialize ListInboundShipmentsRequest.
     *
     * @param  Requests\ListInboundShipmentsRequest
     * @return array
     */
/*
    protected function serializeListInboundShipmentsRequest(Requests\ListInboundShipmentsRequest $request): array
    {
        $retArr = ['Action' => 'ListInboundShipments'];

		// ShipmentStatusList
		if (!empty($request->ShipmentStatusList)) {
			$reflection  = new ReflectionClass(Types\ShipmentStatus::class);
			$validValues = $reflection->getConstants();
			$pos = 1;

			foreach ($request->ShipmentStatusList as $status) {
				if (in_array($status, $validValues)) {
					$retArr['ShipmentStatusList.member.'.$pos] = $status;
					$pos++;
				}
			}
		}

		// ShipmentIdList
		if (!empty($request->ShipmentIdList)) {
			$pos = 1;

			foreach ($request->ShipmentIdList as $shipment) {
				$retArr['ShipmentIdList.member.'.$pos] = $status;
				$pos++;
			}
		}

		// LastUpdatedAfter
		if ($request->LastUpdatedAfter instanceof DateTimeInterface) {
			$retArr['LastUpdatedAfter'] = $request->LastUpdatedAfter->format(static::DATE_FORMAT);
		}

		// LastUpdatedAfter
		if ($request->LastUpdatedBefore instanceof DateTimeInterface) {
			$retArr['LastUpdatedBefore'] = $request->LastUpdatedBefore->format(static::DATE_FORMAT);
		}

        return $retArr;
    }
*/

    /**
     * Serialize GetServiceStatusRequest.
     *
     * @param  Requests\GetServiceStatusRequest
     * @return array
     */
/*
    protected function serializeGetServiceStatusRequest(Requests\GetServiceStatusRequest $request): array
    {
        return ['Action' => 'GetServiceStatus'];
    }
*/
}