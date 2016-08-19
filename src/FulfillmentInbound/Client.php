<?php

namespace SellerWorks\Amazon\FulfillmentInbound;

use SellerWorks\Amazon\Common\AbstractClient;
use SellerWorks\Amazon\Credentials\CredentialsInterface;

/**
 * Fulfillment Inbound Shipment API
 *
 * With the Fulfillment Inbound Shipment API section of Amazon Marketplace Web Service (Amazon MWS), you can create and
 * update inbound shipments of inventory in the Amazon Fulfillment Network. You can also request lists of inbound
 * shipments or inbound shipment items based on criteria that you specify. After your inventory has been received by the
 * Amazon Fulfillment Network, Amazon can fulfill your orders regardless of whether you are selling on Amazon's retail
 * web site or through other retail channels.
 *
 * @method  ListInboundShipments                Returns a list of inbound shipments.
 * @method  ListInboundShipmentsByNextToken     Returns the next page of inbound shipments.
 * @method  GetServiceStatus                    Returns the operational status of the Orders API section.
 */
class Client extends AbstractClient implements FulfillmentInboundInterface
{
    /**
     * Import the Fulfillment Inbound Shipment API plumbing methods.
     *
     * @method  ListInboundShipments                Returns a list of inbound shipments.
     * @method  ListInboundShipmentsByNextToken     Returns the next page of inbound shipments.
     * @method  GetServiceStatus                    Returns the operational status of the API section.
     *
     * @method  ListInboundShipmentsAsync
     * @method  ListInboundShipmentsByNextTokenAsync
     * @method  GetServiceStatusAsync
     */
    use FulfillmentInboundTrait;

    /**
     * MWS Service definitions.
     */
    const MWS_PATH    = '/FulfillmentInboundShipment/2010-10-01/';
    const MWS_VERSION = '2010-10-01';

    /**
     * {@inheritDoc}
     */
    public function __construct(CredentialsInterface $credentials)
    {
        parent::__construct($credentials);

        $this->serializer = new Serializer\Serializer;
    }
}
