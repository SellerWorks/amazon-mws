<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Common\Mock;

use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\Passport;
use SellerWorks\Amazon\MWS\Common\SerializerInterface;

/**
 * Mock Amazon MWS API Client
 */
class MockClient extends AbstractClient
{
    /**
     * MWS Service definitions.
     */
    const MWS_PATH    = '/FulfillmentInboundShipment/2010-10-01/';
    const MWS_VERSION = '2010-10-01';

    /**
     * Return mockable UTC timestamp.
     *
     * @return string
     *
     * @codeCoverageIgnore
     */
    protected function gmdate()
    {
        // 2016-06-13 20:29:44
        return gmdate(SerializerInterface::DATE_FORMAT, 1465849784);
    }
}
