<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Request;

use SellerWorks\Amazon\Common\RequestInterface;
use SellerWorks\Amazon\FulfillmentInbound\Entity;

/**
 * Updates an existing inbound shipment.
 *
 * @see http://docs.developer.amazonservices.com/en_US/fba_inbound/FBAInbound_UpdateInboundShipment.html
 */
final class UpdateInboundShipmentRequest implements RequestInterface
{
    /**
     * @var string
     */
    public $ShipmentId;

    /**
     * @var InboundShipmentHeader
     */
    public $InboundShipmentHeader;

    /**
     * @var Array<InboundShipmentItem>
     */
    public $InboundShipmentItems;

    /**
     * {@inheritDoc}
     */
    public function getMetadata()
    {
        return [
            'ShipmentId'            => ['type' => 'scalar'],
            'InboundShipmentHeader' => ['type' => 'object', 'subtype' => Entity\InboundShipmentHeader::class],
            'InboundShipmentItems'  => [
                'type'      => 'array',
                'subtype'   => Entity\InboundShipmentItem::class,
                'namespace' => 'member',
            ],
        ];
    }
}
