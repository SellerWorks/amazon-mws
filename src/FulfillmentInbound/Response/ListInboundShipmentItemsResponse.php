<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * ListInboundShipmentItems response object.
 */
final class ListInboundShipmentItemsResponse implements ResponseInterface
{
    /**
     * @var ListInboundShipmentItemsResult
     */
    public $ListInboundShipmentItemsResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->ListInboundShipmentItemsResult;
    }
}