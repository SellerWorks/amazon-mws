<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use DateTimeInterface;
use ReflectionClass;
use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 * Returns a list of inbound shipments based on criteria that you specify.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipments.html
 */
final class ListInboundShipmentsRequest implements RequestInterface
{
    /**
     * @var Array<string>
     */
    public $ShipmentStatusList;

    /**
     * @var Array<string>
     */
    public $ShipmentIdList;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedAfter;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedBefore;

    /**
     * {@inheritDoc}
     */
    public function getParameters(): array
    {
        $request = [
            'Action' => 'ListInboundShipments',
        ];


		// ShipmentStatusList
		if (!empty($this->ShipmentStatusList)) {
			$classRefl   = new ReflectionClass(Types\ShipmentStatus::class);
			$validValues = $classRefl->getConstants();
			$pos = 1;

			foreach ($this->ShipmentStatusList as $status) {
				if (in_array($status, $validValues)) {
					$request['ShipmentStatusList.member.'.$pos] = $status;
					$pos++;
				}
			}
		}


		// ShipmentIdList
		if (!empty($this->ShipmentIdList)) {
			$pos = 1;

			foreach ($this->ShipmentIdList as $shipment) {
				$request['ShipmentIdList.member.'.$pos] = $status;
				$pos++;
			}
		}


		// LastUpdatedAfter
		if ($this->LastUpdatedAfter instanceof DateTimeInterface) {
			$request['LastUpdatedAfter'] = $this->LastUpdatedAfter->format(static::DATE_FORMAT);
		}


		// LastUpdatedAfter
		if ($this->LastUpdatedBefore instanceof DateTimeInterface) {
			$request['LastUpdatedBefore'] = $this->LastUpdatedBefore->format(static::DATE_FORMAT);
		}

        return $request;
    }
}