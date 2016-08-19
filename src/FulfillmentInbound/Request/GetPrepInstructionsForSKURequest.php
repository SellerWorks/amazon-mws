<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns labeling requirements and item preparation instructions to help you prepare items for an inbound shipment.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPrepInstructionsForSKU.html
 */
final class GetPrepInstructionsForSKURequest implements RequestInterface
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
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'SellerSKUList'     => ['type' => 'choice', 'multiple' => true, 'namespace' => 'Id'],
            'ShipToCountryCode' => ['type' => 'scalar'],
        ];
    }
}
