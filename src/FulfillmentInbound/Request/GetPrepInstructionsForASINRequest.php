<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns item preparation instructions to help with item sourcing decisions.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForASIN.html
 */
final class GetPrepInstructionsForASINRequest implements RequestInterface
{
	/**
	 * @var Array<string>
	 */
	public $ASINList;

	/**
	 * @var string
	 */
	public $ShipToCountryCode;
}
