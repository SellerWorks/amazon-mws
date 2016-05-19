<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound;

use SellerWorks\Amazon\MWS\Common\AbstractClient;

/**
 */
class Client extends AbstractClient
{
    const MWS_VERSION   = '2010-10-01';
    const MWS_PATH      = '/FulfillmentInboundShipment/2010-10-01/';
    const XML_SERVICE   = __NAMESPACE__ . '\\XmlService';
}