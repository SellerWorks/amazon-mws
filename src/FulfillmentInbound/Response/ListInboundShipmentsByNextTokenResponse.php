<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * ListInboundShipmentsByNextToken response object.
 */
final class ListInboundShipmentsByNextTokenResponse implements ResponseInterface
{
    /**
     * @var ListInboundShipmentsByNextTokenResult
     */
    public $ListInboundShipmentsByNextTokenResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->ListInboundShipmentsByNextTokenResult;
    }
}