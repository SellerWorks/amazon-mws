<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use DateTimeInterface;
use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\Requests\Request;

/**
 * Returns a list of items in a specified inbound shipment, or a list of items that were updated within a specified time
 * frame.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItems.html
 */
final class ListInboundShipmentItemsRequest extends Request implements RequestInterface
{
    /**
     * @var string
     */
    public $ShipmentId;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedAfter;

    /**
     * @var DateTimeInterface
     */
    public $LastUpdatedBefore;

    /**
     * Construct object by parameters.  Optional to use.
     *
     * @param  string $ShipmentId
     * @param  DateTimeInterface $LastUpdatedAfter
     * @param  DateTimeInterface $LastUpdatedBefore
     */
    public function __construct(
        string $ShipmentId = null,
        DateTimeInterface $LastUpdatedAfter = null,
        DateTimeInterface $LastUpdatedBefore = null
    )
    {
        $this->ShipmentId = $ShipmentId;
        $this->LastUpdatedAfter = $LastUpdatedAfter;
        $this->LastUpdatedBefore = $LastUpdatedBefore;
    }
}