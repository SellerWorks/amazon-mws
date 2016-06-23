<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\Requests\Request;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;

/**
 * Returns the information required to create an inbound shipment.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_CreateInboundShipmentPlan.html
 */
final class CreateInboundShipmentPlanRequest extends Request implements RequestInterface
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
     * Optional create by constructor.
     *
     * @param  Address  $ShipFromAddress
     * @param  string   $ShipToCountryCode
     * @param  string   $ShipToCountrySubdivisionCode
     * @param  string   $LabelPrepPreference
     * @param  array    $InboundShipmentPlanRequestItems
     */
    public function __construct(
        Entities\Address $ShipFromAddress = null,
        string $ShipToCountryCode = null,
        string $ShipToCountrySubdivisionCode = null,
        string $LabelPrepPreference = null,
        array $InboundShipmentPlanRequestItems = []
    )
    {
        $this->ShipFromAddress                 = $ShipFromAddress;
        $this->ShipToCountryCode               = $ShipToCountryCode;
        $this->ShipToCountrySubdivisionCode    = $ShipToCountrySubdivisionCode;
        $this->LabelPrepPreference             = $LabelPrepPreference;
        $this->InboundShipmentPlanRequestItems = $InboundShipmentPlanRequestItems;
    }
}