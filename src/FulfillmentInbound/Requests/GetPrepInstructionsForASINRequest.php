<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;

/**
 * Returns item preparation instructions to help with item sourcing decisions.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForASIN.html
 */
final class GetPrepInstructionsForASINRequest implements RequestInterface
{
	/**
	 * @var string
	 */
	public $ASINList;

	/**
	 * @var string
	 */
	public $ShipToCountryCode;
}