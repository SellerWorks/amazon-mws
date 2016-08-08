<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns the information required to create an inbound shipment.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipmentPlan.html
 */
final class CreateInboundShipmentPlanRequest implements RequestInterface
{
	/**
	 * @var Address
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
	 * @var Array<InboundShipmentPlanRequestItem>
	 */
	public $InboundShipmentPlanRequestItems;
}
