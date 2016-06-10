<?php

declare(strict_types=1);

namespace SellerWorks\Amazon\MWS\FulfillmentInbound\Responses;

use SellerWorks\Amazon\MWS\Common\ResponseInterface;
use SellerWorks\Amazon\MWS\Common\ResultInterface;

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
    public function getResult(): ResultInterface
    {
        return $this->CreateInboundShipmentPlanResult;
    }
}