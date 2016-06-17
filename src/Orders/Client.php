<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\Orders;

use SellerWorks\Amazon\MWS\Common\AbstractClient;
use SellerWorks\Amazon\MWS\Common\RecordIterator;
use SellerWorks\Amazon\MWS\Common\Requests\GetServiceStatusRequest;
use SellerWorks\Amazon\MWS\Common\Results\GetServiceStatusResult;
use SellerWorks\Amazon\MWS\Common\Passport;

/**
 * Amazon MWS Orders
 *
 * With the Orders API section of Amazon Marketplace Web Service (Amazon MWS), you can build simple applications that
 * retrieve only the order information that you need. This enables you to develop fast, flexible, custom applications in
 * areas like order synchronization, order research, and demand-based decision support tools.
 *
 * @url http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/
 * @version 2013-09-01
 */
class Client extends AbstractClient implements OrdersInterface
{
    /**
     * MWS Service definitions.
     */
    const MWS_PATH    = '/Orders/2013-09-01/';
    const MWS_VERSION = '2013-09-01';

    /**
     * {@inheritDoc}
     */
    public function __construct(Passport $passport = null)
    {
        parent::__construct($passport);
        $this->setSerializer(new Serializer);
    }

    /**
     * Returns the operational status of the Orders API section.
     *
     * @see http://docs.developer.amazonservices.com/en_US/orders-2013-09-01/MWS_GetServiceStatus.html
     *
     * @param  GetServiceStatusRequest  $request
     * @param  Passport  $passport
     * @return GetServiceStatusResult
     */
    function GetServiceStatus(): GetServiceStatusResult
    {
        $response = $this->makeRequest(new GetServiceStatusRequest);

        return $response->GetServiceStatusResult;
    }
}