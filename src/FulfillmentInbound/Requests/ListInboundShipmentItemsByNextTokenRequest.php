<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;

/**
 * 
 *
 * @see 
 */
final class ListInboundShipmentItemsByNextTokenRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $NextToken;
}