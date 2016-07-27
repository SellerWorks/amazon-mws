<?php

namespace SellerWorks\Amazon\FulfillmentInbound;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;

use SellerWorks\Amazon\Common\AbstractClient;
use SellerWorks\Amazon\Common\RecordIterator;
use SellerWorks\Amazon\Common\Requests\GetServiceStatusRequest;
use SellerWorks\Amazon\Common\Results\GetServiceStatusResult;
use SellerWorks\Amazon\Credentials\CredentialsInterface;

/**
 * With the Fulfillment Inbound Shipment API section of Amazon Marketplace Web Service (Amazon MWS), you can create and
 * update inbound shipments of inventory in the Amazon Fulfillment Network. You can also request lists of inbound
 * shipments or inbound shipment items based on criteria that you specify. After your inventory has been received by the
 * Amazon Fulfillment Network, Amazon can fulfill your orders regardless of whether you are selling on Amazon's retail
 * web site or through other retail channels.
 */
class Client extends AbstractClient implements FulfillmentInboundInterface
{
    /**
     * MWS Service definitions.
     */
    const MWS_PATH    = '/FulfillmentInboundShipment/2010-10-01/';
    const MWS_VERSION = '2010-10-01';

    /**
     * {@inheritDoc}
     */
    public function __construct(CredentialsInterface $credentials = null)
    {
        parent::__construct($credentials);
//         $this->setSerializer(new Serializer);
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
                return $response->GetServiceStatusResult;
            }
        );

        return $promise;
    }
}