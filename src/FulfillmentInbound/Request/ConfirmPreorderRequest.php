<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Confirms a shipment for pre-order.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ConfirmPreorder.html
 */
final class ConfirmPreorderRequest implements RequestInterface
{
	/**
	 * @var string
	 */
	public $ShipmentId;

	/**
	 * @var DateTimeInterface|string
	 */
	public $NeedByDate;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'ShipmentId' => ['type' => 'scalar'],
            'NeedByDate' => ['type' => 'datetime'],
        ];
    }
}
