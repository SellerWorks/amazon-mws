<?php

namespace SellerWorks\Amazon\Common\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns the operational status of the Fulfillment Inbound Shipment API section.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/MWS_GetServiceStatus.html
 */
final class GetServiceStatusRequest extends Request implements RequestInterface
{
}