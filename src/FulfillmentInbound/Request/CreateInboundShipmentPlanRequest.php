<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Request;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\FulfillmentInbound\Entity;

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

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'ShipFromAddress'                   => ['type' => 'object', 'subtype' => Entity\Address::class],
            'ShipToCountryCode'                 => ['type' => 'scalar'],
            'ShipToCountrySubdivisionCode'      => ['type' => 'scalar'],
            'LabelPrepPreference'               => ['type' => 'choice', 'choices' => [
                'SELLER_LABEL',
                'AMAZON_LABEL_ONLY',
                'AMAZON_LABEL_PREFERRED',
            ]],
            'InboundShipmentPlanRequestItems'   => [
                'type'      => 'array',
                'subtype'   => Entity\InboundShipmentPlanRequestItem::class,
                'namespace' => 'member',
            ],
        ];
    }
}
