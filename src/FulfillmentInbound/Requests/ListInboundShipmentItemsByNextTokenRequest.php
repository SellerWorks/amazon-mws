<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\Requests\Request;

/**
 * Returns the next page of inbound shipment items using the NextToken parameter.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_ListInboundShipmentItemsByNextToken.html
 */
final class ListInboundShipmentItemsByNextTokenRequest extends Request implements RequestInterface
{
    /**
     * @var string
     */
    public $NextToken;

    /**
     * Optional create by constructor.
     *
     * @param  string  $NextToken
     */
    public function __construct(
        string $NextToken = null
    )
    {
        $this->NextToken = $NextToken;
    }
}