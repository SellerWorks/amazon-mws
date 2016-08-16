<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Request;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Sends transportation information to Amazon about an inbound shipment.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_PutTransportContent.html
 */
final class PutTransportContentRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $ShipmentId;

    /**
     * @var bool
     */
    public $IsPartnered;

    /**
     * @var string
     */
    public $ShipmentType;

    /**
     * @var TransportDetailInput
     */
    public $TransportDetails;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'ShipmentId'       => ['type' => 'scalar'],
            'IsPartnered'      => ['type' => 'boolean'],
            'ShipmentType'     => ['type' => 'choice', 'choices' => ['All', 'SP', 'LTL']],
            'TransportDetails' => ['type' => 'object', 'subtype' => Entity\TransportDetailInput::class],
        ];
    }
}
