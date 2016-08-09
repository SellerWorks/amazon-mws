<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Request;

use SellerWorks\Amazon\Common\RequestInterface;

/**
 * Returns the next page of inbound shipments using the NextToken parameter.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentsByNextToken.html
 */
final class ListInboundShipmentsByNextTokenRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $NextToken;
}
