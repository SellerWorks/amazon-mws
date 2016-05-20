<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;
use SellerWorks\Amazon\MWS\FulfillmentInbound\Types;

/**
 */
class XmlService extends \Sabre\Xml\Service
{
    /**
     */
    public function __construct()
    {
        $namespace = '{http://mws.amazonaws.com/FulfillmentInboundShipment/2010-10-01/}';
        $this->mapValueObject($namespace . 'GetServiceStatusResponse', Responses\GetServiceStatusResponse::class);
    }
}