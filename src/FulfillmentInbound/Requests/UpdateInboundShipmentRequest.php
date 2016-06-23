<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\Requests\Request;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Entities;

/**
 * Updates an existing inbound shipment.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_UpdateInboundShipment.html
 */
final class UpdateInboundShipmentRequest extends Request implements RequestInterface
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

    /**
     * Optional create by constructor.
     *
     * @param  string  $ShipmentId
     * @param  InboundShipmentHeader  $InboundShipmentHeader
     * @param  array  $InboundShipmentItems
     */
    public function __construct(
        string $ShipmentId = null,
        Entities\InboundShipmentHeader $InboundShipmentHeader = null,
        array $InboundShipmentItems = []
    )
    {
        $this->ShipmentId            = $ShipFromAddress;
        $this->InboundShipmentHeader = $ShipToCountryCode;
        $this->InboundShipmentItems  = $InboundShipmentItems;
    }
}