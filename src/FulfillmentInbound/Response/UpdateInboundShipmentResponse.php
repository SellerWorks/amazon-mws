<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * UpdateInboundShipment response object.
 */
final class UpdateInboundShipmentResponse implements ResponseInterface
{
    /**
     * @var UpdateInboundShipmentResult
     */
    public $UpdateInboundShipmentResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->UpdateInboundShipmentResult;
    }
}