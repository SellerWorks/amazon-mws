<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\Requests\AbstractRequest;

/**
 * Returns a list of items in a specified inbound shipment, or a list of items that were updated within a specified time
 * frame.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItems.html
 */
final class ListInboundShipmentItemsRequest extends AbstractRequest
{
}