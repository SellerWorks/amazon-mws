<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * ListInboundShipments response object.
 */
final class ListInboundShipmentsResponse implements ResponseInterface
{
    /**
     * @var ListInboundShipmentsResult
     */
    public $ListInboundShipmentsResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->ListInboundShipmentsResult;
    }
}