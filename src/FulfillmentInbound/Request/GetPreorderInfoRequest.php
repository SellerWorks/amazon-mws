<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns pre-order information, including dates, that a seller needs before confirming a shipment for pre-order. Also
 * indicates if a shipment has already been confirmed for pre-order.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_GetPreorderInfo.html
 */
final class GetPreorderInfoRequest implements RequestInterface
{
	/**
	 * @var string
	 */
	public $ShipmentId;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'ShipmentId' => ['type' => 'scalar'],
        ];
    }
}
