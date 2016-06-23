<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\Requests\Request;

/**
 * Returns labeling requirements and item preparation instructions to help you prepare items for an inbound shipment.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForSKU.html
 */
final class GetPrepInstructionsForSKURequest extends Request implements RequestInterface
{
	/**
	 * @var Array<string>
	 */
	public $SellerSKUList;

	/**
	 * @var string
	 */
	public $ShipToCountryCode;

    /**
     * Optional create by constructor.
     *
     * @param  array   $SellerSKUList
     * @param  string  $ShipToCountryCode
     */
    public function __construct(
        array $SellerSKUList = [],
        string $ShipToCountryCode = null
    )
    {
        $this->SellerSKUList     = $SellerSKUList;
        $this->ShipToCountryCode = $ShipToCountryCode;
    }
}