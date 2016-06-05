<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;

/**
 * Returns the information required to create an inbound shipment.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipmentPlan.html
 */
final class CreateInboundShipmentPlanRequest implements RequestInterface
{
	/**
	 * @var SellerWorks\Amazon\MWS\FulfillmentInbound\Types\Address
	 */
	public $ShipFromAddress;

	/**
	 * @var string
	 */
	public $ShipToCountryCode;

	/**
	 * @var string
	 */
	public $ShipToCountrySubdivisionCode;

	/**
	 * @var string
	 */
	public $LabelPrepPreference;

	/**
	 * @var ArrayCollection<SellerWorks\Amazon\MWS\FulfillmentInbound\Types\InboundShipmentPlanRequestItem>
	 */
	public $InboundShipmentPlanRequestItems;
}