<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * ListInboundShipmentItemsByNextToken response object.
 */
final class ListInboundShipmentItemsByNextTokenResponse implements ResponseInterface
{
    /**
     * @var ListInboundShipmentItemsByNextTokenResult
     */
    public $ListInboundShipmentItemsByNextTokenResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->ListInboundShipmentItemsByNextTokenResult;
    }
}