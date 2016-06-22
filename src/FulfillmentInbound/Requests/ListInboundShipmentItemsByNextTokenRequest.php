<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Requests;

use SellerWorks\Amazon\MWS\Common\RequestInterface;
use SellerWorks\Amazon\MWS\Common\Requests\Request;

/**
 * 
 *
 * @see 
 */
final class ListInboundShipmentItemsByNextTokenRequest extends Request implements RequestInterface
{
    /**
     * @var string
     */
    public $NextToken;
}