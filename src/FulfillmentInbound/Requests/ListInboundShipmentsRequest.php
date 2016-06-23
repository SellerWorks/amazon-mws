<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use DateTimeInterface;
use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\Requests\Request;

/**
 * Returns a list of inbound shipments based on criteria that you specify.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipments.html
 */
final class ListInboundShipmentsRequest extends Request implements RequestInterface
{
    /**
     * @var Array<string>
     */
    public $ShipmentStatusList;

    /**
     * @var Array<string>
     */
    public $ShipmentIdList;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedAfter;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedBefore;

    /**
     * Optional create by constructor.
     *
     * @param  array  $ShipmentStatusList
     * @param  array  $ShipmentIdList
     * @param  DateTimeInterface  $LastUpdatedAfter
     * @param  DateTimeInterface  $LastUpdatedBefore
     */
    public function __construct(
        array $ShipmentStatusList = [],
        array $ShipmentIdList = [],
        DateTimeInterface $LastUpdatedAfter = null,
        DateTimeInterface $LastUpdatedBefore = null
    )
    {
        $this->ShipmentStatusList = $ShipmentStatusList;
        $this->ShipmentIdList     = $ShipmentIdList;
        $this->LastUpdatedAfter   = $LastUpdatedAfter;
        $this->LastUpdatedBefore  = $LastUpdatedBefore;
    }
}