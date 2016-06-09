<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\Requests\AbstractRequest;

/**
 * Returns the operational status of the Fulfillment Inbound Shipment API section.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/MWS_GetServiceStatus.html
 */
final class GetServiceStatusRequest extends AbstractRequest
{
}