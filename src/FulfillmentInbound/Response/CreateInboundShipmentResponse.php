<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * CreateInboundShipmentPlan response object.
 */
final class CreateInboundShipmentResponse implements ResponseInterface
{
    /**
     * @var CreateInboundShipmentResult
     */
    public $CreateInboundShipmentResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->CreateInboundShipmentResult;
    }
}