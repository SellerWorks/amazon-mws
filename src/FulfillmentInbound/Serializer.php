<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use DateTimeInterface;
use ReflectionClass;
use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\SerializerInterface;

/**
 */
class Serializer implements SerializerInterface
{
	/**
	 * @const  string
	 */
	const DATE_FORMAT = 'Y-m-d\TH:i:s\Z';

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
        switch (true) {
            case $request instanceof Requests\ListInboundShipmentsRequest:
                return $this->serializeListInboundShipmentsRequest($request);

            case $request instanceof Requests\GetServiceStatusRequest:
                return $this->serializeGetServiceStatusRequest($request);

            default:
                throw new UnexpectedValueException(__CLASS__ . ' is not supported.');
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
     * Serialize ListInboundShipmentsRequest.
     *
     * @param  Requests\ListInboundShipmentsRequest
     * @return array
     */
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

    /**
     * Serialize GetServiceStatusRequest.
     *
     * @param  Requests\GetServiceStatusRequest
     * @return array
     */
    protected function serializeGetServiceStatusRequest(Requests\GetServiceStatusRequest $request): array
    {
        return ['Action' => 'GetServiceStatus'];
    }
}