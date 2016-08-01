<?php

namespace SellerWorks\Amazon\Orders;

use SellerWorks\Amazon\Common\AbstractClient;
use SellerWorks\Amazon\Common\Request\GetServiceStatusRequest;
use SellerWorks\Amazon\Common\Result\GetServiceStatusResult;
use SellerWorks\Amazon\Credentials\CredentialsInterface;

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
    public function __construct(CredentialsInterface $credentials = null)
    {
        parent::__construct($credentials);
        $this->setSerializer(new Serializer\Serializer);
    }

    /**
     * @return GetServiceStatusResult
     */
    public function GetServiceStatus()
    {
        return $this->GetServiceStatusAsync()->wait();
    }

    /**
     * @return PromiseInterface
     */
    public function GetServiceStatusAsync()
    {
        $promise = $this->send(new GetServiceStatusRequest)->then(
            function ($response) {
                $response = $this->serializer->unserialize($response);
                return $response->GetServiceStatusResult;
            }
        );

        return $promise;
    }
}
