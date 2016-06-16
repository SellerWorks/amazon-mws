<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;

/**
 * Creates an inbound shipment.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipment.html
 */
final class CreateInboundShipmentRequest implements RequestInterface
{
	/**
	 * @var string
	 */
	public $ShipmentId;

	/**
	 * @var InboundShipmentHeader
	 */
	public $InboundShipmentHeader;

	/**
	 * @var Array<InboundShipmentItem>
	 */
	public $InboundShipmentItems;
}