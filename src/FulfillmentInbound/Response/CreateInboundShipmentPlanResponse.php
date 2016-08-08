<?php

namespace SellerWorks\Amazon\FulfillmentInbound\Response;

use SellerWorks\Amazon\Common\ResponseInterface;

/**
 * CreateInboundShipmentPlan response object.
 */
final class CreateInboundShipmentPlanResponse implements ResponseInterface
{
    /**
     * @var CreateInboundShipmentPlanResult
     */
    public $CreateInboundShipmentPlanResult;

    /**
     * @var ResponseMetadata
     */
    public $ResponseMetadata;

    /**
     * {@inheritDoc}
     */
    public function getResult()
    {
        return $this->CreateInboundShipmentPlanResult;
    }
}